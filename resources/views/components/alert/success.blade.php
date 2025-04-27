@if(session()->has('success'))
    <div id="success-alert" class="alert alert-success d-flex" role="alert">
            {{session()->get('success')}}
            <button id="success-alert-button" class="ms-auto" type="button">
                X
            </button>
    </div>

    <script>
        const myComponent = document.getElementById('success-alert');
        const hideButton = document.getElementById('success-alert-button');

        hideButton.addEventListener('click', function() {
            myComponent.remove();
        });
    </script>
@endif