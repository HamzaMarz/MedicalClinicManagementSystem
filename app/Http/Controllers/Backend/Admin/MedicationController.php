<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicationController extends Controller{

    public function addMedication(){
        return view('Backend.admin.medications.add');
    }


    public function storeMedication(Request $request){
        $existingMedication = Medication::where('name', $request->name)->where('dosage_form', $request->dosage_form)->where('category', $request->category)->where('expiry_date', $request->expiry_date)->first();
        if($existingMedication){
            return response()->json(['data' => 0]);
        }else{

            Medication::create([
                'pharmacy_id' => 1,
                'name' => $request->name,
                'dosage_form' => $request->dosage_form,
                'category' => $request->category,
                'expiry_date' => $request->expiry_date,
                'selling_price' => $request->selling_price,
                'description' => $request->description,
            ]);
                return response()->json(['data' => 1]);
        }
    }





    public function viewMedications(){
        $medications = Medication::orderBy('id', 'asc')->paginate(10);
        return view('Backend.admin.medications.view' , compact('medications'));
    }





    public function searchMedications(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $medications = Medication::query();

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $medications->where('name', 'like', "{$keyword}%");
                    break;

                case 'dosage_form':
                    $medications->where('dosage_form', 'like', "{$keyword}%");
                    break;

                case 'category':
                    $medications->where('category', 'like', "{$keyword}%");
                    break;

                    case 'status':
                        // مبدئياً هات كل الأدوية
                        $medications = $medications->get()->filter(function ($medication) use ($keyword) {
                            return stripos($medication->status, $keyword) !== false;
                        });

                        // بما إنه صارت Collection، نرجع نعمل paginate يدوي
                        $page     = request()->get('page', 1);
                        $perPage  = 12;
                        $offset   = ($page * $perPage) - $perPage;
                        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                            $medications->slice($offset, $perPage)->values(),
                            $medications->count(),
                            $perPage,
                            $page,
                            ['path' => request()->url(), 'query' => request()->query()]
                        );

                        $medications = $paginated;
                        break;
                }
            }

            if ($filter !== 'status') {
                $medications = $medications->orderBy('id')->paginate(12);
            }

        $view       = view('Backend.admin.medications.searchMedication', compact('medications'))->render();
        $pagination = $medications->total() > 12 ? $medications->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $medications->total(),
            'searching'  => $keyword !== '',
        ]);
    }





    public function detailsMedication($id){
        $medication = Medication::findOrFail($id);
        return view('Backend.admin.medications.details', compact('medication'));
    }





    public function editMedication($id){
        $medication = Medication::findOrFail($id);
        return view('Backend.admin.medications.edit', compact('medication'));
    }


    public function updateMedication(Request $request, $id){
        $medication = Medication::findOrFail($id);
        $existingMedication = Medication::where('name', $request->name)->where('dosage_form', $request->dosage_form)->where('category', $request->category)->where('expiry_date', $request->expiry_date)->where('id', '!=', $id)->first();
        if($existingMedication){
            return response()->json(['data' => 0]);
        }else{
            $medication->update([
                'name' => $request->name,
                'dosage_form' => $request->dosage_form,
                'category' => $request->category,
                'description' => $request->description,
                'expiry_date' => $request->expiry_date,
                'selling_price' => $request->selling_price,
            ]);
            return response()->json(['data' => 1]);
        }
    }





    public function deleteMedication($id){
        $medication = Medication::findOrFail($id);
        $medication->delete();
        return response()->json(['success' => true]);
    }





    public function viewTrashedMedications(){
        $medications = Medication::onlyTrashed()->paginate(12);
        return view('Backend.admin.medications.trashed.viewTrashed', compact('medications'));
    }





    public function searchTrashedMedications(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $medications = Medication::onlyTrashed();

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $medications->where('name', 'like', "{$keyword}%");
                    break;

                case 'dosage_form':
                    $medications->where('dosage_form', 'like', "{$keyword}%");
                    break;

                case 'category':
                    $medications->where('category', 'like', "{$keyword}%");
                    break;

                case 'status':
                    $medications->where('status', 'like', "{$keyword}%");
                    break;
            }
        }

        $medications = $medications->orderBy('id')->paginate(12);

        $view       = view('Backend.admin.medications.trashed.searchTrashedMedication', compact('medications'))->render();
        $pagination = $medications->total() > 12 ? $medications->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $medications->total(),
            'searching'  => $keyword !== '',
        ]);
    }





    public function restoreMedication($id){
        $medication = Medication::onlyTrashed()->findOrFail($id);
        $medication->restore();
        return response()->json(['success' => true]);
    }




    public function forceDeleteMedication($id){
        $medication = Medication::onlyTrashed()->findOrFail($id);
        $medication->stocks()->forceDelete();
        $medication->pharmacies()->forceDelete();
        $medication->forceDelete();
        return response()->json(['success' => true]);
    }





    public function forceDeleteAllMedications(){
        $medications = Medication::onlyTrashed()->get();
        foreach ($medications as $medication) {
            $medication->stocks()->delete();
            $medication->pharmacies()->delete();
            $medication->forceDelete();
        }

        return response()->json(['success' => true]);
    }
}
