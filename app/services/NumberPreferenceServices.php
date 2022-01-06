<?php
namespace App\Services;

use App\Models\NumberPreference;
use Exception;
use Illuminate\Support\Facades\DB;

class NumberPreferenceServices
{
  protected $repository;
  public function __construct(NumberPreference $numberPreference)
  {
    $this->repository = $numberPreference;
  }

  public function createNumberPreference($data)
  {
    $retorno = ['erro' => false, 'msg' => ''];

    try {
      DB::beginTransaction();
      $numbpref = $this->repository->create($data);
      
      if (!$numbpref->save())
        return $retorno = [ 'erro' => true, 'msg' => 'Failed to complete the registration of this contact'];

      DB::commit();
      return $retorno;
    } catch (Exception $e) {
      DB::rollBack();
      return $retorno = [ 'erro' => true, 'msg' => $e->getMessage()];
    }
  }

  public function findNumberPreference($id){
    return $this->repository->where('number_id', $id)->get();
  }
}