<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Historic;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
use Carbon\Carbon;

class BalanceController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        $mutable = Carbon::now();
        $balance = auth()->user()->balance; # RECEBE O SALDO
        $amout = $balance ? $balance->amount : 0; # VERIFICA O SALDO

        $data = User::where('user_id', auth()->user()->id)->get();

        return view('admin.balance.index', compact('amout', 'data', 'mutable'));
    }

    public function deposit()
    {
        $data['users'] = auth()->user()->users->pluck('name', 'id');
        return view('admin.balance.deposit', $data);
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {
        //$balance = auth()->user()->balance()->firstOrCreate([]);
        $balance = User::find($request->user_id)->balance()->firstOrCreate([]);
        //dd(User::find($request->user_id));
        $request->value = str_replace(',', '.', str_replace('.', '', $request->value));
        //dd($request->value);
        //number_format($number, 2, '.', '')
        $response = $balance->deposit($request->value, $request->user_id);

        if ($response['success'])
            return redirect()
                    ->route('admin.balance')
                    ->with('success', $response['message']);

        return redirect()
                ->back()
                ->with('error', $response['message']);
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }



    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        if ($response['success'])
            return redirect()
                    ->route('admin.balance')
                    ->with('success', $response['message']);

        return redirect()
                ->back()
                ->with('error', $response['message']);
    }

    public function transfer(Request $request)
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user)
    {
        if (!$sender = $user->getSender($request->sender))
            return redirect()
                    ->back()
                    ->with('error', 'O usuário informado não foi encontrado!');

        if ($sender->id == auth()->user()->id)
            return redirect()
                        ->back()
                        ->with('error', 'Não pode transferir para você mesmo!');


        $balance = auth()->user()->balance; # RECUPERA O SALDO DO USUÁRIO


        return view('admin.balance.transfer-confirm',compact('sender', 'balance'));
    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {
        if (!$sender = $user->find($request->sender_id))
            return redirect()
                    ->route('balance.transfer')
                    ->with('success', 'Recebedor não encontrado!');

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $sender);

        if ($response['success'])
            return redirect()
                    ->route('admin.balance')
                    ->with('success', $response['message']);

        return redirect()
                ->route('admin.balance')
                ->with('error', $response['message']);
    }

    public function historic(Historic $historic)
    {

        $ids[] = auth()->user()->id;
        $ids[] = auth()->user()->user_id;
        $ids[] = User::where('user_id', auth()->user()->user_id)->first()->user_id;
        //dd(auth()->user()->roles->whereIn('name', ['diretoria', 'financeiro'])->count());
        if(auth()->user()->roles->whereIn('name', ['admin', 'diretoria', 'financeiro'])->count() > 0){
            $historics = Historic::with(['userSender'])
            ->paginate($this->totalPage);

        }else{
            $historics = auth()->user()
                ->historics()
                ->with(['userSender'])
                ->paginate($this->totalPage);


        }

        $pessoas = Historic::with(['userSender'])
        //->where('user_id', auth()->user()->id)
        ->whereIn('id', $ids)
        ->paginate($this->totalPage);
        //dd($pessoas);



        $types = $historic->type();

        return view('admin.balance.historics', compact('historics', 'types', 'pessoas'));
    }

    public function searchHistoric(Request $request, Historic $historic)
    {

        $ids[] = auth()->user()->id;
        $ids[] = auth()->user()->user_id;
        $ids[] = User::where('user_id', auth()->user()->user_id)->first()->user_id;

        $dataForm = $request->except('_token');

        $historics = $historic->search($dataForm, $this->totalPage);

        $types = $historic->type();

        $pessoas = Historic::with(['userSender'])
        //->where('user_id', auth()->user()->id)
        ->whereIn('id', $ids)
        ->paginate($this->totalPage);

        return view('admin.balance.historics', compact('historics', 'types', 'dataForm', 'pessoas'));

    }



    public function darok($id)
    {

        $fff = Historic::find($id);

        //$bbb = Balance::where('user_id', $fff->user_if)->first();

        $fff->update(['status' => 'Confirmado']);


        $balance = User::find($fff->user_id)->balance()->firstOrCreate([]);
        $value = $fff->amount;
        $response = $balance->deposit($value, $fff->user_id, true);


        //$bbb->update(['status' => 'Confirmado']);

            return redirect()
                    ->route('admin.balance')
                    ->with('success', 'Confirmado pagamento');

    }



}
