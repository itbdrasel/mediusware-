<form action="{{ url($bUrl) }}" method="post"  class="form-inline">
    @csrf
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
        <div class="col">
            <select class="form-control" name="per_page" id="per_page" class="form-control">

                <option value=""> Per page </option>
                @php
                    $perPageRecords = [5,10,15,20,30,40,50,60,70,80,90,100];
                @endphp
                @foreach ($perPageRecords as $p)
                    <option value="{{ $p }}"  {{ session('per_page') == $p ? 'selected' : '' }} >{{ $p }}</option>
                @endforeach;

            </select>
        </div>	<!--/form-row-->

    </div>

</form>
