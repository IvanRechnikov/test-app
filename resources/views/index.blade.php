@extends('layouts.default')

@section('wrapper')
    @include('components.title', ['title' => 'Короткий URL для всех!'])
    <form>
        <div class="mb-3">
            <label for="link" class="form-label">Ссылка</label>
            <input type="text" name="link" class="form-control" id="link" placeholder="https://profilancegroup.com/about">
        </div>
        <div class="errors"></div>
        <button
            onclick="compressLink()"
            type="button"
            class="btn btn-primary"
        >Создать</button>
        <div class="alert alert-success shortlink mt-3 d-none" role="alert"></div>
    </form>
    <script>
        const compressLink = () => {
            const link = document.querySelector('#link').value
            const formData = new FormData;
            formData.append('link', link)
            fetch('/compress', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            }).then(res => {
                return res.json()
            }).then(data => {
                if (data.status) {
                    const shortlinkEl = document.querySelector('.shortlink');
                    shortlinkEl.classList.remove('d-none');
                    shortlinkEl.innerText = `Ваша ссылка: ${data.shortlink}`;
                } else if (!data.status) {
                    document.querySelector('.errors').innerHTML = '';
                    for (const err of data.errors.link) {
                        document.querySelector('.errors').innerHTML += `<div class="alert alert-danger" role="alert">${err}</div>`;
                    }
                }
            }).catch(err => {
                console.log(err)
            })
        }
    </script>
@endsection
