<?php

namespace App\Http\Controllers\Api\internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Utility;

use App\Models\DataTodoListModel;

use App\Events\DataTodoListStore;
use App\Events\DataTodoListDelete;

use DB;

class apiDataTodoListController extends Controller
{
    public function index() {
        try {
            $dataTodoListModelObj = DataTodoListModel::all();

            if(!is_null($dataTodoListModelObj))
                return response()->json([
                    'successful'    => 1,
                    'message'       => '',
                    'data'          => $dataTodoListModelObj,
                    'definitions'   => '',
                    'functionName'  => ''
                ]);

            throw new \Exception('An error occured, please try again.');
        } catch (\Exception $e) {
            return response()->json(array('successful' => 0, 'message' => 'An error occured, please try again.'));
        }
    }

    public function store(Request $request) {
        Utility::stripXSS($request);

        $request->validate([
          'title' => 'required|min:3',
          'description' => 'required|min:3',
        ]);

        try {
            $user = auth('api')->user();
            DB::beginTransaction();

            $newDataTodoListModel                       = new DataTodoListModel();
            $newDataTodoListModel->created_by_user_id   = $user->id;
            $newDataTodoListModel->title                = $request->title;
            $newDataTodoListModel->description          = $request->description;

            $DataTodoListModelRs                        = $newDataTodoListModel->save();

            if($DataTodoListModelRs) {
                broadcast(new DataTodoListStore($newDataTodoListModel));
                DB::commit();
                return response()->json([
                        'successful'    => 1,
                        'message'       => 'Successfully completed.',
                        'data'          => '1',
                        'functionName'  => 'showTodoList'
                    ]);
            }

            throw new \Exception('An error occured, please try again.');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('successful' => 0, 'message' => 'An error occured, please try again.'));
        }
    }

    public function destroy($id) {
        Utility::stripSingleXSS($id);

        try {
            DB::beginTransaction();
            $dataTodoListModel = DataTodoListModel::find($id);
            broadcast(new DataTodoListDelete($dataTodoListModel));
            $dataTodoListModelRS = $dataTodoListModel::destroy($id);

            if($dataTodoListModelRS) {
                DB::commit();
                return response()->json([
                        'successful'    => 1,
                        'message'       => 'Successfully deleted.',
                        'data'          => [],
                        'functionName'  => ''
                    ]);
            }

            throw new \Exception('An error occured, please try again.');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(array('successful' => 0, 'message' => 'An error occured, please try again.'.$e));
        }

        // $task = Task::find($id);
        // broadcast(new TaskRemoved($task));
        // Task::destroy($id);
        // return response()->json("deleted");
    }
}
