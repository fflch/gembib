<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Mail\MailStl;
use Illuminate\Support\Facades\Mail;

class SendMailStl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail-stl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manda e-mail para o STL dos itens com pedidos de prioridade';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $itens = Item::where('prioridade_processamento',1)
        ->where('email_enviado',0)
        ->get();
        
        //este pluck retorna uma coleção de ids com base na busca acima: [1, 2, 3]
        $item = Item::whereIn('id',$itens->pluck('id'))->update(['email_enviado' => true]); //atualizando o campo email com base no id de $itens
     
        if($item){
            Mail::queue(new MailStl($itens));
        }
    }
}
