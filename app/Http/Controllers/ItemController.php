<?php

namespace App\Http\Controllers;

use App\Item;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    /* Etapa 1 - Sugestão */
    public function index()
    {
        // select * from item where status="Sugestão"
        $this->authorize('logado');
        $itens = item::where('status',"Sugestão")->get();
        return view('itens/index',compact('itens'));
    }

    public function create()
    {
        $this->authorize('logado');
        return view('itens/create');
        $user = new User;
    }

    public function store(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            'titulo'  => 'required',
            /* 'autor'   => 'required', */
            /* 'editora' => 'required', */
        ]);

        /* pegar itens que estão chegando e salvar no banco de dados */
        $item = new Item;
        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->sugerido_por_id = Auth::id();

        $item->status = "Sugestão";
        $item->save();

        $request->session()->flash('alert-info', 'Sugestão enviada com sucesso');

        return redirect('/');
    }


    /* Etapa 2 - Processar Sugestão */
    public function processar_sugestao(Item $item)
    {
        $this->authorize('stl');
        return view('itens/processar_sugestao',compact('item'));
    }

    public function store_processar_sugestao(Request $request, Item $item)
    {
        $this->authorize('stl');
        if($request->status == 'Negado') {
            $request->validate([
                'motivo'  => 'required',
            ]);
            $item->motivo = $request->motivo;
        }

        /* Alterar status */
        $item->status = $request->status;

        /*Outros status*/
        $outroStatus = $request->outroStatus;
        if($request->status == 'Outro'){
            $item->status = $outroStatus;
        }
        /*fim outros status*/

        $item->save();
        $request->session()->flash('alert-info',"Sugestão processada, novo status: {$item->status}");
        return redirect('/itens');
    }

    /* Etapa 3 - Processar tombamento */
    public function processar_tombamento(item $tombamento)
    {
        $this->authorize('sai');
        $areas = Area::all();
        return view('itens/processar_tombamento',compact('tombamento','areas'));
    }

    public function store_processar_tombamento(Request $request, item $tombamento)
    {
        /* Validação de campos */
        $this->authorize('sai');
        $request->validate([
             'titulo'          => 'required',
            //'autor'            => 'required',
            //'editora'          => 'required',
            //'tombo'            => 'required',
            //'cod_impressao'    => 'required',
            //'ordem_relatorio'  => 'required',
            //'tipo_tombamento'  => 'required',
            'tipo_material'    => 'required',
            //'capes'            => 'required',//
            //'edicao'           => 'required',
            //'volume'           => 'required',
            //'local'            => 'required',
            //'ano'              => 'required',
            //'isbn'             => 'required',
            //'escala'           => 'required',
            //'dpto'             => 'required',
            //'pedido_por'       => 'required',
            //'finalidade'       => 'required',
            /* 'data_pedido'      => 'required', */
            //'prioridade'       => 'required',
            //'status'           => 'required',
            //'moeda'            => 'required',
            //'preco'            => 'required',
            //'procedencia'      => 'required',
            //'observacao'       => 'required',
            //'verba'            => 'required',
            //'processo'         => 'required',
            //'fornecedor'       => 'required',
            //'nota_fiscal'      => 'required',
            /* 'data_nf'          => 'required',  */
        ]);

        /* Alterar status */
        $tombamento->status = "Em tombamento";

        /*Salvar*/
        $tombamento->motivo = $request->motivo;
        $tombamento->tombo = $request->tombo;
        $tombamento->tombo_antigo = $request->tombo_antigo;
        $tombamento->cod_impressao = $request->cod_impressao;
        $tombamento->ordem_relatorio = $request->ordem_relatorio;
        $tombamento->tipo_tombamento = $request->tipo_tombamento;
        $tombamento->tipo_material = $request->tipo_material;
        //$tombamento->outros_tipos = $request->outros_tipos;//
        $tombamento->subcategoria = $request->subcategoria;
        $tombamento->capes = $request->capes;
        $tombamento->UsuarioS = $request->UsuarioS;
        $tombamento->UsuarioA = $request->UsuarioA;
        $tombamento->titulo = $request->titulo;
        $tombamento->autor = $request->autor;
        $tombamento->link = $request->link;
        $tombamento->edicao = $request->edicao;
        $tombamento->volume = $request->volume;
        $tombamento->parte = $request->parte;
        $tombamento->fasciculo = $request->fasciculo;
        $tombamento->local = $request->local;
        $tombamento->editora = $request->editora;
        $tombamento->ano = $request->ano;
        $tombamento->colecao = $request->colecao;
        $tombamento->isbn = $request->isbn;
        $tombamento->escala = $request->escala;
        $tombamento->dpto = $request->dpto;
        $tombamento->pedido_por = $request->pedido_por;
        $tombamento->finalidade = $request->finalidade;
        // formatar: $tombamento->data_pedido = $request->$data_pedido;        
        $tombamento->prioridade = $request->prioridade;
        $tombamento->status = $request->status;
        $tombamento->moeda = $request->moeda;
        $tombamento->preco = $request->preco;
        $tombamento->procedencia = $request->procedencia;
        $tombamento->observacao = $request->observacao;
        $tombamento->verba = $request->verba;
        $tombamento->processo = $request->processo;
        $tombamento->fornecedor = $request->fornecedor;
        $tombamento->nota_fiscal = $request->nota_fiscal;
        // formatar: $tombamento->data_nf = $request->$data_nf;

        //Salvar valor escolhido em Subcategoria - FUNCIONANDO 
        $subcategoria = $request->subcategoria;//name
        if($request->tipo_material == 'Teses'){
            $tombamento->subcategoria = $subcategoria;
        }
        //Salvar valor digitado em Outros - FUNCIONANDO 
        $outroMaterial = $request->outromaterial;        
        if($request->tipo_material == 'Outros'){
            $tombamento->tipo_material = $outroMaterial;
        }
        //Salvar valor digitado em Escala - FUNCIONANDO 
        $valorescala = $request->escala;
        if($request->tipo_material == 'Mapas'){
            $tombamento->escala = $valorescala;
        }

        $tombamento->save();

        $request->session()->flash('alert-info',"Aquisição processada, novo status: {$tombamento->status}");
        return redirect('/');
    }


    //Processar Aquisição
    public function lista_aquisicao()
    {
        $this->authorize('sai');
/*         $itens = item::where('status',"Em processo de aquisição")
                        ->orWhere('status',"Inserido pelo usuário")
                        ->get();
                        Código criado para listar livros na inserção direta */
        $itens = item::where('status', "Em processo de aquisição")->get();
        return view('itens/lista_aquisicao',compact('itens'));
        //$users = User::select ();
        //return view('itens/lista_aquisicao',compact('users'));
    }

    public function consulta()
    {
        $itens = item::all();
        return view('itens/consulta',compact('itens'));
    }

    // Inserção direta
    public function createInsercao()
    {
        $this->authorize('logado');
        return view('itens/insercao');
    }

    public function storeInsercao(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            //'tombo'            => 'required',
            //'titulo'           => 'required',
            //'autor'            => 'required',
            //'cod_impressao'    => 'required',
            //'tipo_tombamento'   => 'required',
            //'tipo_material'    => 'required',
            //'editora'          => 'required',
        ]);

        /* pegar itens que estão chegando e salvar no banco de dados */
        $item = new Item;
        $item->titulo = $request->titulo;
        $item->autor = $request->autor;
        $item->editora = $request->editora;
        $item->ano = $request->ano;
        $item->sugerido_por_id = Auth::id();
        $item->tombo = $request->tombo;
        $item->tombo_antigo = $request->tombo_antigo;
        $item->tipo_tombamento = $request->tipo_tombamento;
        $item->tipo_material = $request->tipo_material;
        $item->parte = $request->parte;
        $item->volume = $request->volume;
        $item->fasciculo = $request->fasciculo;
        $item->local = $request->local;
        $item->colecao = $request->colecao;
        $item->isbn = $request->isbn;
        $item->link = $request->link;
        $item->edicao = $request->edicao;
        $item->dpto = $request->dpto;
        $item->prioridade = $request->prioridade;
        $item->procedencia = $request->procedencia;
        $item->verba = $request->verba;
        $item->processo = $request->processo;
        $item->fornecedor = $request->fornecedor;
        $item->moeda = $request->moeda;
        $item->preco = $request->preco;
        $item->nota_fiscal = $request->nota_fiscal;
        // formatar: $item->data_nf = $request->$data_nf;
        $item->cod_impressao = $request->cod_impressao;
        $item->observacao = $request->observacao;

        /*Outra prioridade*/
        $outraPrioridade = $request->outraPrioridade;
        if($request->prioridade == 'Outra'){
            $item->prioridade = $outraPrioridade;
        }
        /*fim outra prioridade*/

        /*Outra verba*/
        $outraVerba = $request->outraVerba;
        if($request->verba == 'Outras'){
            $item->verba = $outraVerba;
        }
        /*fim outra verba*/

        //Salvar valor escolhido em Subcategoria - N ESTÁ FUNCIONANDO
        $subcategoria = $request->subcategoria;//name
        if($request->tipo_material == 'Teses'){
            $item->subcategoria = $subcategoria;
        }
        //Salvar valor digitado em Tipo de Material - FUNCIONANDO
        $outroMaterial = $request->outromaterial;        
        if($request->tipo_material == 'Outros'){
            $item->tipo_material = $outroMaterial;
        }
        //Salvar valor digitado em Escala - FUNCIONANDO
        $valorescala = $request->escala;
        if($request->tipo_material == 'Mapas'){
            $item->escala = $valorescala;
        }


        $item->status = "Inserido pelo usuário";
        $item->save();

        $request->session()->flash('alert-info', 'Inserção direta enviada com sucesso');

        return redirect('/');
        
    }

}
