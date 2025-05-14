<style>
    :root {
        --color-default: #212529;
        --color-default-rgb: 33, 37, 41;
        --color-background: #ffffff;
        --color-background-rgb: 255, 255, 255;
        --color-primary: #f49805;
        --color-primary-rgb: 15, 67, 51;
        --color-secondary: #32353a;
        --color-third: #0f4333;
        --color-secondary-rgb: 50, 53, 58;
        --color-box-background: #ffffff;
        --color-box-background-rgb: 255, 255, 255;
        --color-inverse: #ffffff;
        --color-inverse-rgb: 255, 255, 255;
    }

    /* Faq Section - Home Page
                        ------------------------------*/
    .faq .content h3 {
        color: var(--color-secondary);
        font-weight: 400;
        font-size: 34px;
    }

    .faq .content p {
        font-size: 15px;
        color: rgba(var(--color-default-rgb), 0.7);
    }

    .faq .faq-container .faq-item {
        position: relative;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0px 5px 25px 0px rgba(var(--color-default-rgb), 0.1);
        overflow: hidden;
    }

    .faq .faq-container .faq-item:last-child {
        margin-bottom: 0;
    }

    .faq .faq-container .faq-item h3 {
        color: var(--color-secondary);
        font-weight: 600;
        font-size: 18px;
        line-height: 24px;
        margin: 0 30px 0 0;
        transition: 0.3s;
        cursor: pointer;
        display: flex;
        align-items: flex-start;
    }

    .faq .faq-container .faq-item h3 .num {
        color: var(--color-primary);
        padding-right: 5px;
    }

    .faq .faq-container .faq-item h3:hover {
        color: var(--color-primary);
    }

    .faq .faq-container .faq-item .faq-content {
        display: grid;
        grid-template-rows: 0fr;
        transition: 0.3s ease-in-out;
        visibility: hidden;
        opacity: 0;
    }

    .faq .faq-container .faq-item .faq-content p {
        margin-bottom: 0;
        overflow: hidden;
    }

    .faq .faq-container .faq-item .faq-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 16px;
        line-height: 0;
        transition: 0.3s;
        cursor: pointer;
    }

    .faq .faq-container .faq-item .faq-toggle:hover {
        color: var(--color-primary);
    }

    .faq .faq-container .faq-active h3 {
        color: var(--color-primary);
    }

    .faq .faq-container .faq-active .faq-content {
        grid-template-rows: 1fr;
        visibility: visible;
        opacity: 1;
        padding-top: 10px;
    }

    .faq .faq-container .faq-active .faq-toggle {
        transform: rotate(90deg);
        color: var(--color-primary);
    }
</style>
<section id="faq" class="faq">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="content px-xl-5">
                    <h3><span>Our &nbsp; </span><strong>Mission & Vision</strong></h3>
                    <p>
                        FR.URIOS ACADEMY OF MAGALLANES, INC
                    </p>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                <div class="faq-container">
                    <div class="faq-item faq-active">
                        <h3><span class="num">1.</span> <span>Vision</span></h3>
                        <div class="faq-content">
                            <p><strong>Christ-centered persons who care for the earth and fellow human beings.</strong>
                            </p>
                            <ul>

                            </ul>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->

                    <div class="faq-item  faq-active">
                        <h3><span class="num">2.</span> <span>Mission</span>
                        </h3>
                        <div class="faq-content">

                            <ul class="list-unstyled">
                                <li class="mb-2"><strong class="text-uppercase">CATECHISM</strong> - To know Christ
                                    better and the teachings of the church.</li>
                                <li class="mb-2"><strong class="text-uppercase">STEWARDSHIP</strong> - To become
                                    humble and obedient servants of God.</li>
                                <li class="mb-2"><strong class="text-uppercase">STUDENT-CENTERED</strong> - The
                                    students (individually and as a group) are the center of the school's mission.</li>
                                <li class="mb-2"><strong class="text-uppercase">COLLABORATIVE LEARNING</strong> -
                                    Fostering a collaborative relationship between students and teachers; students and
                                    students.</li>
                            </ul>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->




                </div>

            </div>
        </div>

    </div>

</section>