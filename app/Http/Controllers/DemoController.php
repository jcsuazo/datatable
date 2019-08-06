<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DemoTask;

class DemoController extends Controller
{
    public function showDatatable()
    {
        $tasks = DemoTask::orderBy('order', 'ASC')->select('id', 'title', 'status', 'created_at', 'order')->get();

        return view('demos.sortabledatatable', compact('tasks'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = DemoTask::all();

        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }
}
