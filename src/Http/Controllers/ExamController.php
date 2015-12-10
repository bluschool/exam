<?php namespace Bluschool\Exam\Http\Controllers;


use Bluschool\Exam\Http\Requests\ExamRequest;
use Bluschool\Exam\Model\Exam;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;

class ExamController extends AdminController {

    public function __construct()
    {
//        $this->middleware('registration');
        $this->middleware('exam');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Exam $exam)
	{
        return view('bluschool/exam::exam', compact('exam'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('bluschool/exam::edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ExamRequest $request )
	{
        try {
            $file = Input::file('file1');
            $filename1 = 'exam_'.uniqid() . '.jpg';
            $destinationPath = 'images/exam';
            $itemImage = Image::make($file)->fit(350, 450);
            $itemImage->save($destinationPath . '/' . $filename1);
            $request['photo'] = $destinationPath.'/'.$filename1;

            $attachFile = Input::file('file2');
            $filename2 = 'exam_attach_'.uniqid() . '.jpg';
            $destinationPathAttach = 'images/exam';
            $itemAttachment = Image::make($attachFile)->fit(450, 350);

            $itemAttachment->save($destinationPathAttach . '/' . $filename2);
            $request['attachment'] = $destinationPathAttach.'/'.$filename2;

            $exam = Exam::create($request->all());

        } catch (Exception $e) {
            Flash::error('Unable to Save');
            return $this->redirect(handles('bluschool/exam::exam'));
        }
        Flash::success($exam->name.' Saved Successfully');
        return $this->redirect(handles('bluschool/exam::member'));

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}