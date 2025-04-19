<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Đánh giá từ khách hàng</h4>
            <h1 class="display-5 mb-5 text-dark">Uy tín tạo niềm tin !</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            @foreach ($reviews as $review)
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="{{ $review->user->image_url }}" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">{{ $review->user->name }}</h4>


                                <div class="d-flex pe-5">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star {{ $i < $review->rating ? 'text-warning' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
