<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApplicationFormRequest;
use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Models\User\ICRevoked;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\ImportedCommoditiesRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class OrderOfPaymnetController extends Controller
{

    protected $importedCommodities;
    public function __construct(ImportedCommoditiesRepository $importedCommodities)
    {
        $this->importedCommodities = $importedCommodities;
    }

    public function create(){

        return view('dashboard.ImportedCommodities.create');

    }

    public function edit($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.edit', compact('data'));
    }



    public function update(Request $request, $slug) {
        $app_data = ImportedCommodities::where('slug', $slug)->firstOrFail();
        $app_data->received = $request->received;
        $app_data->received_date = now();
        $app_data->revoked = 0;
        $app_data->save();
        return response()->json(['slug' => $app_data->slug]);
    }






    public function show($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.show', compact('data'));
    }


    public function orderOfPayment($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.edit', compact('data'));
    }

}
