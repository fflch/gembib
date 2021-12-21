Aluno(a,e), {{ $aluno->name }} <br>
Está pedindo o(s) seguinte(s) item(ns) através do Sistema Gembib:<br>
    @foreach($itens as $item)
        tombo: {{ $item->tombo }}, {{ $item->titulo }}.<br>
    @endforeach
