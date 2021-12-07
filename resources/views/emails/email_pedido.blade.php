Aluno(a,e), {{ $aluno->name }} <br>
Está pedindo o(s) seguinte(s) item(ns):<br>
    @foreach($itens as $item)
        {{ $item->tombo }}, {{ $item->titulo }}.<br>
    @endforeach
Cheque o sistema gembib.
