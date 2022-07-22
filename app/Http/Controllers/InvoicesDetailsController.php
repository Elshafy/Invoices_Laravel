<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    public function edit($id)

    {
        $invoices = invoices::where('id', $id)->first();
        $details  = invoices_Details::where('id_Invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoice', compact('invoices', 'details', 'attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
    public function open_file($invoice_number, $file_name)

    {
        // $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);

        // $files = Storage::disk('public_uploads')->get($invoice_number . '/' . $file_name);
        // $path = Storage::url($files);
        // dd($files);
        // $path = public_path() . '/public_uploads' . $invoice_number . '/' . $file_name;



        $url = Storage::disk('public_uploads')->path($invoice_number . '/' . $file_name);
        //"/storage/123124/jfile_name.pdf" ||expected "/home/shafai/Desktop/mora/public/Attachments/123124/jfile_name.pdf"
        // dd($url);
        return response()->file($url);

        // 14=> 29:00
    }

    public function get_file($invoice_number, $file_name)

    {
        // $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        // return response()->download($contents);
        // $files = Storage::disk('public_uploads')->get($invoice_number . '/' . $file_name);
        return Storage::disk('public_uploads')->download($invoice_number . '/' . $file_name);
        // return response()->download($files);
    }
}
