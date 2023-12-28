<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FAQsController extends Controller
{
    //
    public function index($id = null)
    {
        # code...
        $data['title'] = "FAQs";
        if($id != null){
            $data['faqs'] = \App\Models\FAQ::where('id', $id)->get();
        }else{
            $data['faqs'] = \App\Models\FAQ::orderBy('id', 'DESC')->get();
        }
        return view('admin.faqs.index', $data);
    }
    //
    //
    public function public_index($id = null)
    {
        # code...
        $data['title'] = "FAQs";
        if($id != null){
            $data['faqs'] = \App\Models\FAQ::where('id', $id)->paginate(12);
        }else{
            $data['faqs'] = \App\Models\FAQ::orderBy('title')->paginate(12);
        }
        return view('public.faqs.index', $data);
    }
    //
    public function edit($id)
    {
        # code...
        $data['title'] = "Edit FAQ item";
        $data['item'] = \App\Models\FAQ::find($id);
        if($data['item'] != null){
            return view('admin.faqs.edit', $data);
        }else
        return back()->with('error', 'cannot resolve FAQ item');
    }
    //
    public function update($id, Request $request)
    {
        # code...
        $validity = Validator::make($request->all(), ['title'=>'required', 'content'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        if(\App\Models\FAQ::where('id', '!=', $id)->where(['title'=>$request->title])->count() > 0){
            session()->flash('error', 'Another FAQ item with the supplied title already exist.');
            return back()->withInput();
        }

        \App\Models\FAQ::where('id', $id)->update(['title'=>$request->title, 'content'=>nl2br($request->content)]);
        return redirect()->route('admin.faqs.index');
    }
    //
    public function delete($id)
    {
        # code...
        if(\App\Models\FAQ::where('id', $id)->count() > 0){
            \App\Models\FAQ::where('id', $id)->each(function($rec){
                $rec->delete();
            });
        }
        return back()->with('success', 'Operated completed');
    }
    //
    public function create()
    {
        # code...
        $data['title'] = "Create FAQ Item";
        return view('admin.faqs.create', $data);
    }
    //
    public function save(Request $request)
    {
        # code...
        $validity = Validator::make($request->all(), ['title'=>'required', 'content'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        if(\App\Models\FAQ::where('title', $request->title)->count() > 0){
            session()->flash('error', "A FAQ item with specified title already exist");
            return back()->withInput();
        }

        (new \App\Models\FAQ(['title'=>$request->title, 'content'=>nl2br($request->content)]))->save();
        return redirect()->route('admin.faqs.index')->with('success', "FAQ item succcessfully created.");
    }
}
