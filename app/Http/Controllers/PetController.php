<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Services\PetApiService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    private $petApiService;

    public function __construct(PetApiService $petApiService)
    {
        $this->petApiService = $petApiService;
    }

    public function index(Request $request)
    {
        try {
            $status = $request->query('status', 'available');
            $response = $this->petApiService->findByStatus($status);
            return view('pets.index', ['pets' => $response->json()]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $response = $this->petApiService->findById($id);
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
            $this->petApiService->create($petData);
            return redirect()->route('pets.index')->with('success', 'Pet added successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->petApiService->findById($id);
            return view('pets.edit', ['pet' => $response->json()]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(StorePetRequest $request)
    {
        try {
            $petData = $this->formatPetData($request);
            $this->petApiService->update($petData);
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->petApiService->delete($id);
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function uploadImage(Request $request, $id)
    {
        try {
            $this->petApiService->uploadImage($id, $request->file('image'));
            return back()->with('success', 'Image uploaded successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
}
