@if(session()->has('deleted'))
    <div id="deleted-alert" class="alert alert-danger d-flex" role="alert">
            {{session()->get('deleted')}}
            <button id="deleted-alert-button" class="ms-auto" type="button">
                X
            </button>
    </div>

    <script>
        const myComponent = document.getElementById('deleted-alert');
        const hideButton = document.getElementById('deleted-alert-button');

        hideButton.addEventListener('click', function() {
            myComponent.remove();
        });
    </script>
@endif