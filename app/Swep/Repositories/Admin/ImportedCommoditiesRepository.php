<?php


namespace App\Swep\Repositories\Admin;

use App\Models\User\ImportedCommodities;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\ApplicationInterface;

class ImportedCommoditiesRepository extends BaseRepository implements ApplicationInterface {
    protected $importedCommodities;

    public function __construct(ImportedCommodities $importedCommodities)
    {
        $this->importedCommodoties = $importedCommodities;
        parent::__construct();
    }

//    public function fetchTable($data){
//        $get = $this->$this->importedCommodoties;
//        return $get->all();
//    }

    public function fetchTable($data)
    {
        return $this->importedCommodoties
            ->where('submission', 1)
            ->where('received', 0)
            ->orderByDesc('submission_date');
    }

    public function fetchTableRevoked($data)
    {
        return $this->importedCommodoties
            ->where('revoked', 1)
            ->orderByDesc('revoked_date');

    }

    public function fetchTableApproved($data)
    {
        return $this->importedCommodoties
            ->where('received', 1)
            ->orderByDesc('received_date');
    }

    public function fetch($request)
    {
        // TODO: Implement fetch() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $slug)
    {
        // TODO: Implement update() method.
    }

    public function destroy($slug)
    {
        // TODO: Implement destroy() method.
    }
}