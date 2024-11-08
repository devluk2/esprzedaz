<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    private $baseUrl = 'https://petstore.swagger.io/v2/pet';

    private function handleApiResponse($response, $defaultErrorMessage)
    {
        if ($response->successful()) {
            return $response;
        }

        $errorMessage = $response->json()['message'] ?? $defaultErrorMessage;
        $statusCode = $response->status();
        throw new \Exception("API Error (Status $statusCode): $errorMessage");
    }

    private function formatPetData(Request $request): array
    {
        $tags = [];
        if ($request->tags) {
            $tagNames = explode(' ', $request->tags);
            $tags = array_map(function ($tagName, $index) {
                return [
                    'id' => $index + 1,
                    'name' => $tagName
                ];
            }, $tagNames, array_keys($tagNames));
        }

        return [
            'id' => $request->id,
            'category' => [
                'id' => $request->category_id,
                'name' => $request->category_name
            ],
            'name' => $request->name,
            'photoUrls' => $request->photo_urls ?? [],
            'tags' => $tags,
            'status' => $request->status
        ];
    }


    public function index(Request $request)
    {
        try {
            $status = $request->query('status', 'available');
            $response = Http::get($this->baseUrl . '/findByStatus', [
                'status' => $status
            ]);

            $this->handleApiResponse($response, 'Failed to fetch pets');
            return view('pets.index', ['pets' => $response->json()]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get($this->baseUrl . '/' . $id);
            $this->handleApiResponse($response, 'Failed to fetch pet details');
            return view('pets.show', ['pet' => $response->json()]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        try {
            $petData = $this->formatPetData($request);
            $response = Http::post($this->baseUrl, $petData);
            $this->handleApiResponse($response, 'Failed to create pet');
            return redirect()->route('pets.index')->with('success', 'Pet added successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = Http::get($this->baseUrl . '/' . $id);
            $this->handleApiResponse($response, 'Failed to fetch pet for editing');
            return view('pets.edit', ['pet' => $response->json()]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(StorePetRequest $request)
    {
        try {
            $petData = $this->formatPetData($request);
            $response = Http::put($this->baseUrl, $petData);
            $this->handleApiResponse($response, 'Failed to update pet');
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->baseUrl . '/' . $id);
            $this->handleApiResponse($response, 'Failed to delete pet');
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function uploadImage(Request $request, $id)
    {
        try {
            $response = Http::attach(
                'file',
                file_get_contents($request->file('image')->path()),
                $request->file('image')->getClientOriginalName()
            )->post($this->baseUrl . '/' . $id . '/uploadImage');

            $this->handleApiResponse($response, 'Failed to upload image');
            return back()->with('success', 'Image uploaded successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
