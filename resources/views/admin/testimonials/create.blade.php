@extends('layouts.admin')

@section('title','Add Review')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">

            <h4>Add Testimonial</h4>

        </div>


        <div class="card-body">

            <form method="POST"
                action="{{ route('admin.testimonials.store') }}">

                @csrf


                <div class="mb-3">

                    <label>Name</label>

                    <input name="name"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>Designation</label>

                    <input name="designation"
                        class="form-control">

                </div>


                <div class="mb-3">

                    <label>Company</label>

                    <input name="company"
                        class="form-control">

                </div>


                <div class="mb-3">

                    <label>Content</label>

                    <textarea name="content"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>


                <div class="mb-3">

                    <label class="form-label">Rating</label>

                    <div class="rating">

                        @for($i=1;$i<=5;$i++)

                            <i class="star fa fa-star"
                            data-value="{{ $i }}"></i>

                            @endfor

                    </div>

                    <input type="hidden"
                        name="rating"
                        id="rating"
                        value="{{ $testimonial->rating ?? 5 }}">

                </div>


                <div class="mb-3">

                    <label>Status</label>

                    <select name="status"
                        class="form-control">

                        <option value="1">

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>


                <button class="btn btn-primary">

                    Save

                </button>


                <a href="{{ route('admin.testimonials.index') }}"
                    class="btn btn-secondary">

                    Cancel

                </a>


            </form>

        </div>

    </div>

</div>
<style>
    .rating .star {

        font-size: 28px;

        cursor: pointer;

        color: #ccc;

        transition: 0.2s;

    }

    .rating .star.active {

        color: #ffc107;

    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        let stars =
            document.querySelectorAll('.rating .star');

        let ratingInput =
            document.getElementById('rating');

        let rating =
            ratingInput.value;



        function setRating(r) {

            stars.forEach((star, index) => {

                if (index < r)

                    star.classList.add('active');

                else

                    star.classList.remove('active');

            });

        }


        setRating(rating);



        stars.forEach(star => {

            star.addEventListener('mouseenter', function() {

                setRating(this.dataset.value);

            });


            star.addEventListener('click', function() {

                ratingInput.value =
                    this.dataset.value;

            });


        });


        document.querySelector('.rating')
            .addEventListener('mouseleave', function() {

                setRating(ratingInput.value);

            });


    });
</script>


@endsection