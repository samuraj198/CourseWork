<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Services\WorksService;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function __construct(private WorksService $worksService)
    {}

    public function downloadFile($id)
    {
        $result = $this->worksService->downloadFile($id);
        if (isset($result['error'])) {
            return redirect()->back()->with('error', $result['error']);
        }
        return $result['response'];
    }

    public function changeStatus(Request $request)
    {
        $work = $this->worksService->changeStatus($request->id, $request->status);

        return redirect()->back()->with('success', 'Вы успешно изменили статус проекта');
    }

    public function store(UpdateWorkRequest $request)
    {
        $data = $request->validated();
        $work = $this->worksService->store($data, $request->file('img'), $request->file('file'));

        return back()->with('success', 'Файл отправлен на проверку');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->worksService->show($id);

        return view('filePage', $result);
    }

    public function update(StoreWorkRequest $request)
    {
        $data = $request->validated();
        $work = $this->worksService->update($data,
                                            $request->file('img'),
                                            $request->file('file'));

        return back()->with('success', 'Изменения внесены. Ваш файл отправлен на проверку');
    }

    public function destroy(Request $request)
    {
        $check = $this->worksService->destroy($request->id);

        if (!$check) {
            return back()->with('error', 'Что-то пошло не так');
        }

        return back()->with('success', 'Файл успешно удален');
    }
}
