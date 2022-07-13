<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;
use App\Models\Stdent;

class StdentController extends Controller
{
    public function getdata(){
        $data = Stdent::all();
        return response()->json([
            'data' => $data,
        ]);

    }
    public function addstudent(Request $req){
        $validator = Validator::make($req->all(),[
            'name' =>'required|max:191',
            'email'=>'required|email|max:191',
            'phone' =>'required|max:191',
            'course'=>'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $students = new Stdent();
            $students->name = $req->name;
            $students->email = $req->email;
            $students->phone = $req->phone;
            $students->course = $req->course;
            $students->save();

            return response()->json([
                'status'=>200,
                'message'=>"Data added successfuly",
            ]);
        }
    }

    public function editdata($id){
        $student = Stdent::find($id);

        if($student){
            return response()->json([
                'status' => 200,
                'student' =>$student,
            ]);

        }else{
            return response()->json([
                'status'=>400,
                'message'=>"Data not found",
            ]);
        }
        

    }

    public function update(Request $req,$id){
        $validator = Validator::make($req->all(),[
            'name' =>'required|max:191',
            'email'=>'required|email|max:191',
            'phone' =>'required|max:191',
            'course'=>'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $students = Stdent::find($id);
            if($students){
            $students->name = $req->name;
            $students->email = $req->email;
            $students->phone = $req->phone;
            $students->course = $req->course;
            $students->update();

            return response()->json([
                'status'=>200,
                'message'=>"Data update successfuly",
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Data not found",
            ]);
        }
        }
    }

    public function delete($id){
        $students = Stdent::find($id);
        $students->delete();
        return response()->json([
            'status'=>404,
            'message'=>"Data delete successfully",
        ]);
    }
}
