<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);

        return response()->json(['message' => 'Contato enviado com sucesso!'], 200);
    }

    // Método para listar todos os contatos
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    // public function index()
    // {
    //     $contacts = Contact::all();
    //     return Inertia::render('PaginaPrincipal', ['contacts' => $contacts]);
    // }

    // Método para exibir um contato específico
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

        // Método para atualizar um contato
        // nao testei
        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:contacts,email,' . $id,
                'surname' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'message' => 'required|string',
            ]);
    
            $contact = Contact::findOrFail($id);
            $contact->update($validatedData);
    
            return response()->json(['message' => 'Contato atualizado com sucesso!'], 200);
        }
    
        // Método para deletar um contato
        // nao testei
        public function destroy($id)
        {
            $contact = Contact::findOrFail($id);
            $contact->delete();
    
            return response()->json(['message' => 'Contato deletado com sucesso!'], 200);
        }
}
