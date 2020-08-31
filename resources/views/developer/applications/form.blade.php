<form action="{{ url($url) }}" method="post" enctype="multipart/form-data" id="editForm">
    @csrf

    @method($method)

    <h5 style="text-align: left">General Details</h5>

    <div class="form-row">

        <div class="form-group col-md-3">
            <label for="name">Title :</label>
            <input type="text" class="form-control" placeholder="Title" name="name" 
            value="{{ old('name', $application->name) }}" required autofocus 
            <?= ($method === 'delete' || $method === 'patch') ? 'disabled' : null ?> >

            <p class="text-danger">{{ $errors->first('name') }}</p>

        </div>

        <div class="form-group col-md-3">
            <label for="category">Category :</label>
            <select name="category_id" id="category" class="form-control" required <?= ($method === 'delete' || $method === 'patch') ? 'disabled' : null ?> >
                @if (! old('category_id'))  <!-- VERIFIES IF EXISTS OLD() VALUE -->
                    @foreach ($categories as $category)
                    <option <?= ($application->category_id == $category->id) ? 'selected' : null ?> 
                    value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @else
                    @foreach ($categories as $category)
                    <option <?= (old('category_id') == $category->id) ? 'selected' : null ?> 
                    value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>

            <p class="text-danger">{{ $errors->first('category_id') }}</p>

        </div>

        <div class="form-group col-md-2">
            <label for="price">Price :</label>
            <input type="text" class="form-control" placeholder="Price" name="price" 
            value="{{ old('price', $application->price) }}" required 
            <?= ($method === 'delete') ? 'disabled' : null ?> >

            <p class="text-danger">{{ $errors->first('price') }}</p>

        </div>

        <div class="form-group col-md-3">
            <label for="image">Image :</label>
            <input type="file" name="image" accept="image/*" class="" id="image"
                aria-describedby="inputGroupFileAddon01" <?= ($method === 'delete') ? 'disabled' : null ?> >

            <p class="text-danger">{{ $errors->first('image') }}</p>

        </div>

    </div>

    <div class="form-group">
        <label for="description">Description :</label>
        <textarea type="text" rows="8" cols="" class="form-control" placeholder="Description" 
        name="description" <?= ($method === 'delete') ? 'disabled' : null ?> >{{ old('description', $application->description) }}</textarea>

        <p class="text-danger">{{ $errors->first('descripcion') }}</p>

    </div>

    <hr>

    <div class="form-group">
        @if ($method === 'post')
        <button type="submit" class="btn btn-success" onclick="event.preventDefault();formSubmit();">Save</button>
        <input type="hidden" name="user_id"  value="{{ auth()->user()->id }}">
        @elseif ($method === 'patch')
        <button type="submit" class="btn btn-warning" onclick="event.preventDefault();formSubmit();">Edit</button>
        @elseif ($method === 'delete')
        <button type="submit" class="btn btn-danger" onclick="event.preventDefault();formSubmit();">Delete</button>
        @endif
    </div>
    
</form>

<script>
    function formSubmit() {
        if(confirm('Confirm operation ?')){
            document.getElementById('editForm').submit();
            console.log('submit success !');
        } else {
            console.log('submit canceled !');
        }
    }
</script>
