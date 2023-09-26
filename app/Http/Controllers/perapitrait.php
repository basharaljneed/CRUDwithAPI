<?php

namespace App\Http\Controllers;

trait perapitrait{

public function infopers($data=null,$mess=null,$status=null){
$arry=[
'data'=>$data,
'message'=>$mess,
'status'=>$status,

];
return response()->json($arry,$status);
}

}


?>