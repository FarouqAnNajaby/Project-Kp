<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('ecommerce.partials.head')

<body>
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    @include('ecommerce.partials.navbar')

    <!-- Main Content -->
    @yield('content')

    @include('ecommerce.partials.footer')
    @include('ecommerce.partials.javascript')
    <script>
        const toNumber = (num) => {
            return parseInt(num.replace(/,.*|[^0-9]/g, ''), 10);
        }
        let filter_kategori = $('input[type=radio][name=kategori]:checked')
        let filter_min_price = $('input[name=min-price]')
        let filter_max_price = $('input[name=max-price]')
        let filter_orderby = $('select[name=orderby]')
        let keyword = $('input[name=keyword]')
        let keyword_mbl = $('input[name=keyword-mbl]')

        $('input[name=kategori]').on('change', function() {
            changeUrl(keyword.val(), this.value, filter_min_price.val(), filter_max_price.val(), filter_orderby.val());
        })
        $('#filter-price').on('click', function() {
            changeUrl(keyword.val(), filter_kategori.val(), filter_min_price.val(), filter_max_price.val(), filter_orderby.val());
        })
        $('select[name=orderby]').on('change', function() {
            changeUrl(keyword.val(), filter_kategori.val(), filter_min_price.val(), filter_max_price.val(), this.value);
        })
        $('.keyword-form').on('submit', function(e) {
            e.preventDefault();
            changeUrl(keyword.val(), filter_kategori.val(), filter_min_price.val(), filter_max_price.val(), filter_orderby.val());
        })
        $('.keyword-mbl-form').on('submit', function(e) {
            e.preventDefault();
            changeUrl(keyword_mbl.val(), filter_kategori.val(), filter_min_price.val(), filter_max_price.val(), filter_orderby.val());
        })
        $('#remove-filter-kategori').on('click', function() {
            changeUrl(keyword_mbl.val(), null, filter_min_price.val(), filter_max_price.val(), filter_orderby.val());
        })
        const changeUrl = (keyword, kategori, min_price, max_price, orderby) => {
            let url = new URL(window.location);
            let params = new URLSearchParams(url.search);
            if (keyword) {
                params.set('keyword', keyword);
            } else {
                params.delete('keyword');
            }

            if (kategori) {
                params.set('kategori', kategori);
            } else {
                params.delete('kategori');
            }

            if (min_price && max_price) {
                min_price = toNumber(min_price);
                max_price = toNumber(max_price);
                if (max_price > min_price) {
                    params.set('min_price', min_price);
                    params.set('max_price', max_price);
                }
            } else {
                params.delete('min_price');
                params.delete('max_price');
            }

            if (orderby) {
                params.set('orderby', orderby);
            } else {
                params.delete('orderby');
            }
            params = params.toString();
            url = window.location.origin + '/barang';
            window.location.href = `${url}?${params}`
        }
    </script>
</body>

</html>