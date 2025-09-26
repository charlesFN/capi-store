<?php

namespace App\Http\Controllers;

use App\Models\Modalidade;
use Illuminate\Http\Request;
use App\Services\ModalidadeService;

class ModalidadesController extends Controller
{
    protected $modalidade_service;

    public function __construct(ModalidadeService $modalidadeService)
    {
        $this->modalidade_service = $modalidadeService;
    }

    public function index()
    {
        $modalidades = Modalidade::orderBy("id","desc")->paginate(10);

        return view('modalidades.index', compact('modalidades'));
    }

    public function create()
    {
        return view('modalidades.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_modalidade' => 'required|unique:modalidades,nome_modalidade|string|max:50'
        ]);

        $response = $this->modalidade_service->save($data);

        if ($response->status() == 200) {
            session()->flash('success', $response->content());
            return redirect()->route('modalidades.index');
        } else {
            session()->flash('error', 'Não foi possível criar a modalidade.');
            return redirect()->route('modalidades.index');
        }
    }

    public function show(Modalidade $modalidade)
    {
        return view('modalidades.show', [
            'modalidade' => $modalidade
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
