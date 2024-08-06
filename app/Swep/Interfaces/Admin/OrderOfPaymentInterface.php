<?php

namespace App\Swep\Interfaces\Admin;



interface OrderOfPaymentInterface {

    public function fetch($request);

    public function store($request);

    public function update($id);

    public function paid($id, $orNumber);

    public function destroy($slug);

}