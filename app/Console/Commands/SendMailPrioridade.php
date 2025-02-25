<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Mail\mail_prioridade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendMailPrioridade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail-prioridade';

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
        $itens = Item::join('users', 'users.email', '=', 'itens.pedido_usuario')
            ->select('itens.id', 'itens.titulo', 'itens.tombo', 'itens.pedido_usuario','users.name','users.codpes')
            ->where('prioridade_processamento',1)
            ->where('email_enviado',0)
            ->get();
        if($itens->isNotEmpty()){
            DB::transaction(function() use ($itens) {
                Item::whereIn('id', $itens->pluck('id'))->update(['email_enviado' => true]);
                Mail::queue(new mail_prioridade($itens->toarray())); //toArray() resolve o problema de Serialização (perde os dados do user)
            });
        }
    }
}
