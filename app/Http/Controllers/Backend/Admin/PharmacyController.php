<?php

namespace App\Http\Controllers\Backend\Admin;


use Illuminate\Http\Request;
use App\Models\MedicationPharmacy;
use App\Http\Controllers\Controller;

class PharmacyController extends Controller{

    public function viewPharmacyInventory(){
        $medicationPharmacies = MedicationPharmacy::paginate(10);
        return view('Backend.admin.pharmacy.viewPharmacyInventory' , compact('medicationPharmacies'));
    }




    public function searchPharmacyInventory(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $medications = MedicationPharmacy::with('medication');

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $medications->whereHas('medication', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'quantity':
                    $medications->where('quantity', 'like', "{$keyword}");
                    break;

                case 'status':
                    // نجيب كل النتائج أولاً
                    $medications = $medications->get()->filter(function ($item) use ($keyword) {
                        return stripos($item->medication->status, $keyword) !== false;
                    });

                    // نرجع نعمل paginate يدوي
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

        $view       = view('Backend.admin.pharmacy.searchPharmacyInventory', compact('medications'))->render();
        $pagination = $medications->total() > 12 ? $medications->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $medications->total(),
            'searching'  => $keyword !== '',
        ]);
    }



}
