@auth()
adminpage=>
{{ auth()->user()->email }}
@endauth