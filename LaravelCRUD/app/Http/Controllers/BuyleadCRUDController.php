<?php
namespace App\Http\Controllers;
use App\Models\Buylead;
use Illuminate\Http\Request;
class BuyleadCRUDController extends Controller{
    public function index(){
        $data['buyleads'] = Company::orderBy('id','desc')->paginate(5);
        return view('buyleads.index', $data);
    }
    public function create(){
        return view('buyleads.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->save();
        return redirect()->route('buyleads.index')
        ->with('success','Buylead has been created successfully.');
    }
    public function show(Company $company){
        return view('buyleads.show',compact('buylead'));
    } 
    public function edit(Company $company){
        return view('buyleads.edit',compact('buylead'));
    }
    public function update(Request $request, $id){    
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->save();
        return redirect()->route('buyleads.index')
        ->with('success','Buylead Has Been updated successfully');
    }
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('buyleads.index')
        ->with('success','Buylead has been deleted successfully');
    }
}
