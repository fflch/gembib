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
            'autor'            => 'required',
            'editora'          => 'required',
            'tombo'            => 'required',
            'cod_impressao'    => 'required',
            /* 'ordem_relatorio'  => 'required', */
            'tipo_tombamento'  => 'required',
            'tipo_material'    => 'required',
            'capes'            => 'required',
            'edicao'           => 'required',
            'volume'           => 'required',
            'local'            => 'required',
            'ano'              => 'required',
            'isbn'             => 'required',
            'escala'           => 'required',
            'dpto'             => 'required',
            'pedido_por'       => 'required',
            'finalidade'       => 'required',
            'prioridade'       => 'required',
            'status'           => 'required',
            'moeda'            => 'required',
            'preco'            => 'required',
            'procedencia'      => 'required',
            'observacao'       => 'required',
            'verba'            => 'required',
            'processo'         => 'required',
            'fornecedor'       => 'required',
            'nota_fiscal'      => 'required',
        ]);
        /* Alterar status */
        $tombamento->status = "Em tombamento";

        /*Salvar*/
        $tombamento->motivo = $request->motivo;
        $tombamento->tombo = $request->tombo;
        $tombamento->tombo_antigo = $request->tombo_antigo;
        $tombamento->cod_impressao = $request->cod_impressao;
        //$tombamento->ordem_relatorio = $request->ordem_relatorio;
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
        //$tombamento->data_sugestao = $request->$data_sugestao;        
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
        $tombamento->data_tombamento = Carbon::now(); // salva automaticamente com a data do tombamento



        /*Outra prioridadeTombamento*/
        $outraPrioridade = $request->outraPrioridade;
        if($request->prioridade == 'Outras'){
            $tombamento->prioridade = $outraPrioridade;
        }
        /*fim outra prioridadeTombamento*/

        /*Outra verbaTombamento*/
        $outraVerba= $request->outraVerba;
        if($request->verba == 'Outras'){
            $tombamento->verba = $outraVerba;
        }


        /*Outros status*/
        $outroStatus = $request->outroStatus;
        if($request->status == 'Outro'){
            $tombamento->status = $outroStatus;
        }
        /*fim outros status*/


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
    public function lista_aquisicao()S
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


