<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>لغات پرتکرار سال گذشته</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @font-face {
            src: url("{{ asset("fonts/iranyekan.woff2") }}");
            font-family: "iran-yekan";
        }
        *{
            direction: rtl;
            font-family: "iran-yekan" !important;
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="container">
    <div class="row justify-content-center table-striped-columns table-hover">
        <div class="col-lg-8 col-12">
            <div class="table-responsive">
                <table class="table table-primary text-center">
                    <thead>
                        <tr>
                            <td>کلمه</td>
                            <td>تعداد تکرار</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($topUsers as $user)
                        <tr>
                            <td>{{ $user->sender }}</td>
                            <td>{{ $user->message_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>
                        <td>😊</td>
                        <td>4666</td>
                    </tr>
                    <tr>
                        <td>نیمکت</td>
                        <td>2123</td>
                    </tr>
                    <tr>
                        <td>ماست</td>
                        <td>1946</td>
                    </tr>
                    <tr>
                        <td>تمرین</td>
                        <td>1552</td>
                    </tr>
                    <tr>
                        <td>کتاب</td>
                        <td>1291</td>
                    </tr>
                    <tr>
                        <td>تمرین</td>
                        <td>1552</td>
                    </tr>
                    <tr>
                        <td>محتوا</td>
                        <td>1098</td>
                    </tr>
                    <tr>
                        <td>کباب</td>
                        <td>951</td>
                    </tr>
                    <tr>
                        <td>درخت</td>
                        <td>949</td>
                    </tr>
                    <tr>
                        <td>مهاجرت</td>
                        <td>951</td>
                    </tr>
                    <tr>
                        <td>ملوک</td>
                        <td>813</td>
                    </tr>
                    <tr>
                        <td>یخچال</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>ملوک</td>
                        <td>813</td>
                    </tr>
                    <tr>
                        <td>عشق</td>
                        <td>799</td>
                    </tr>
                    <tr>
                        <td>دکتر</td>
                        <td>756</td>
                    </tr>
                    <tr>
                        <td>کرگدنِ</td>
                        <td>742</td>
                    </tr>
                    <tr>
                        <td>پرنده</td>
                        <td>651</td>
                    </tr>
                    <tr>
                        <td>روح</td>
                        <td>531</td>
                    </tr>
                    <tr>
                        <td>زمانی</td>
                        <td>474</td>
                    </tr>
                    <tr>
                        <td>😄😄😄😄</td>
                        <td>393</td>
                    </tr>
                    <tr>
                        <td>فوتبال</td>
                        <td>392</td>
                    </tr>
                    <tr>
                        <td>دورهمی</td>
                        <td>352</td>
                    </tr>
                    <tr>
                        <td>ایول</td>
                        <td>346</td>
                    </tr>
                    <tr>
                        <td>خانواده</td>
                        <td>327</td>
                    </tr>
                    <tr>
                        <td>بارون</td>
                        <td>315</td>
                    </tr>
                    <tr>
                        <td>بهشت</td>
                        <td>312</td>
                    </tr>
                    <tr>
                        <td>پیله</td>
                        <td>287</td>
                    </tr>
                    <tr>
                        <td>حسین</td>
                        <td>281</td>
                    </tr>
                    <tr>
                        <td>مادر</td>
                        <td>279</td>
                    </tr>
                    <tr>
                        <td>فحش</td>
                        <td>255</td>
                    </tr>
                    <tr>
                        <td>پدرام</td>
                        <td>243</td>
                    </tr>
                    <tr>
                        <td>معظمی</td>
                        <td>224</td>
                    </tr>
                    <tr>
                        <td>نجاری</td>
                        <td>221</td>
                    </tr>
                    <tr>
                        <td>کمپین</td>
                        <td>218</td>
                    </tr>
                    <tr>
                        <td>تُک</td>
                        <td>196</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
