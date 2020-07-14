    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advisers = Adviser::orderBy('id', 'DESC')->paginate(5);
        return view('admin.advisers.index', compact('advisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advisers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:advisers',
            'email' => 'required|unique:advisers',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);

        Adviser::create($attributes);

        return redirect()->route('asesores.index')->with('message', 'Asesor creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adviser = Adviser::find($id);
        return view('admin.advisers.edit', compact('adviser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adviser = Adviser::find($id);
        $attributes = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:advisers,code,' . $adviser->id ,
            'email' => 'required|unique:advisers,email,' . $adviser->id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);

        $adviser->update($attributes);
        return redirect()->route('asesores.index')->with('message', 'Asesor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Adviser::find($id)->delete();
        return redirect()->route('asesores.index')->with('message', 'Asesor eliminado exitosamente');
    }