<?php

namespace App\Swep\Repositories\Admin;

use App\Models\Admin\OrderOfPayment;
use App\Swep\BaseClasses\Admin\BaseRepository;

use App\Swep\Interfaces\Admin\OrderOfPaymentInterface;
use Auth;

class OrderOfPaymentRepository extends BaseRepository implements OrderOfPaymentInterface {


    protected $orderOfPayment;


    public function __construct(OrderOfPayment $orderOfPayment){
        parent::__construct();
        $this->orderOfPayment = $orderOfPayment;
    }

    public function fetch($slug){

    }

//    public function fetchTable($data){
//        $get = $this->orderOfPayment->with('slug');
//        return $get;
//    }

    public function fetchTable($data){
        return $this->orderOfPayment
            ->where('verify', 1)
            ->orderBy('updated_at', 'desc');
    }

    public function store($request){

    }

    public function update($id){

    }

    public function paid($id, $orNumber){
        $orderOfPayment = OrderOfPayment::where('slug',$id)->first();
        $orderOfPayment->status = "PAID";
        $orderOfPayment->or_number = $orNumber;
        $orderOfPayment->update();
        return $orderOfPayment;
    }

    public function approved($id){
        $orderOfPayment = OrderOfPayment::where('slug',$id)->first();
        $orderOfPayment->status = "APPROVED";
        $orderOfPayment->update();
        return $orderOfPayment;
    }

    public function destroy($slug){

    }

    public function findBySlug($slug){

    }

    public function getRaw(){
        return 2;

    }

    public function allAdminMenusTree(){
    }

}