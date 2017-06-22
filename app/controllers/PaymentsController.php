<?php

class PaymentsController extends \BaseController {

	/**
	 * Display a listing of payments
	 *
	 * @return Response
	 */
	public function index()
	{
		
		/*
		$payments = DB::table('payments')
		          ->join('erporders', 'payments.erporder_id', '=', 'erporders.id')
		          ->join('erporderitems', 'payments.erporder_id', '=', 'erporderitems.erporder_id')
		          ->join('clients', 'erporders.client_id', '=', 'clients.id')
		          ->join('items', 'erporderitems.item_id', '=', 'items.id')
		          ->select('clients.name as client','items.name as item','payments.amount_paid as amount','payments.date as date','payments.erporder_id as erporder_id','payments.id as id','erporders.order_number as order_number')
		          ->get();
		          */

		$erporders = Erporder::all();		
		$erporderitems = Erporderitem::all();		
		$paymentmethods = Paymentmethod::all();
		$payments = Payment::all();
		

		return View::make('payments.index', compact('erporderitems','erporders','paymentmethods','payments'));
	}

	/**
	 * Show the form for creating a new payment
	 *
	 * @return Response
	 */
	public function create()
	{
		$erporders = Erporder::all();
		$accounts = Account::all();
		$erporderitems = Erporderitem::all();
		$paymentmethods = Paymentmethod::all();
		$clients = DB::table('clients')
		         ->join('erporders','clients.id','=','erporders.client_id')
		         ->select( DB::raw('DISTINCT(name),clients.id') )
		         ->get();
		
		return View::make('payments.create',compact('erporders','clients','erporderitems','paymentmethods','accounts'));
	}

	/**
	 * Store a newly created payment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Payment::$rules, Payment::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$erporder = Erporder::find(Input::get('order'));

		$payment = new Payment;

		$client = Client::findOrFail(Input::get('order'));
		$payment->client_id = Input::get('order');
		$payment->erporder_id = Input::get('order');
		$payment->amount_paid = Input::get('amount');			
		$payment->paymentmethod_id = Input::get('paymentmethod');		
		$payment->received_by = Input::get('received_by');
		$payment->date = date("Y-m-d",strtotime(Input::get('pay_date')));
		$payment->save();

		if($client->type === 'Customer'){
			Account::where('id', Input::get('paymentmethod'))->increment('balance', Input::get('amount'));	
		} else{
			Account::where('id', Input::get('paymentmethod'))->decrement('balance', Input::get('amount'));
		}
		

		return Redirect::route('payments.index')->withFlashMessage('Payment successfully created!');
	}

	/**
	 * Display the specified payment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payment = Payment::findOrFail($id);
		$erporderitem = Erporderitem::findOrFail($id);
		$erporder = Erporder::findOrFail($id);

		return View::make('payments.show', compact('payment','erporderitem','erporder'));
	}

	/**
	 * Show the form for editing the specified payment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$payment = Payment::find($id);
		$erporders = Erporder::all();
		$erporderitems = Erporderitem::all();

		return View::make('payments.edit', compact('payment','erporders','erporderitems'));
	}

	/**
	 * Update the specified payment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$payment = Payment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Payment::$rules, Payment::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

      $payment->erporder_id = Input::get('order');
		$payment->amount_paid = Input::get('amount');
		//$payment->balance = Input::get('balance');
		$payment->paymentmethod_id = Input::get('paymentmethod');
		$payment->received_by = Input::get('received_by');
		$payment->date = date("Y-m-d",strtotime(Input::get('pay_date')));
		$payment->update();

		return Redirect::route('payments.index')->withFlashMessage('Payment successfully updated!');
	}

	/**
	 * Remove the specified payment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Payment::destroy($id);

		return Redirect::route('payments.index')->withDeleteMessage('Payment successfully deleted!');
	}

}
