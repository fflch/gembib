Aluno(a,e), {{ $aluno->name }} <br>
Está pedindo o(s) seguinte(s) item(ns):<br>
    @foreach($itens as $item)
        tombo: {{ $item->tombo }}, {{ $item->titulo }}.<br>
    @endforeach
Cheque o sistema gembib.
