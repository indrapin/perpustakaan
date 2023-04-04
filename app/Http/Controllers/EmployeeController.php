<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Termwind\Components\Dd;
use PDF;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate('5');
        } else {
            $data = Employee::paginate('5');
        }
        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }
    public function insertdata(Request $request)
    {
        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        return redirect()
            ->route('pegawai')
            ->with('succes', 'Data Berhasil Diinput');
    }

    public function tampilkandata($id)
    {
        $data = Employee::find($id);
        return view('tampildata', compact('data'));
    }
    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()
            ->route('pegawai')
            ->with('');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()
            ->route('pegawai')
            ->with('success', 'Data Berhasil Dihapus');
    }

    public function eksportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }
}
