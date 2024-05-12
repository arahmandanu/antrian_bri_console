<footer class="bg-black for-footer mt-auto" style="position: absolute; width: 100%; overflow: hidden; bottom: 0">

    @if ($footer_text->count() == 0)
        <p class="text-white walking-text invisible" style="white-space: nowrap; float: left;">-</p>
    @else
        <p id="animate_footer" class="text-white walking-text" style="white-space: nowrap; float: left;"
            flow='{{ $footer_flow }}'></p>
    @endif
</footer>

<script>
    const listTextFooter = {!! json_encode($footer_text) !!};
    $(document).ready(function() {
        if (document.getElementById('animate_footer')) {
            animate();
        }
    });

    function animate(index = 0) {
        var element = document.getElementById('animate_footer');
        const flow = element.getAttribute("flow");
        if (listTextFooter.length == 0) return;
        if (listTextFooter[index] === undefined) return animate();

        $('p#animate_footer').text(listTextFooter[index].text);
        let elementWidth = element.offsetWidth;
        let parentWidth = element.parentElement.offsetWidth;

        if (flow === 'right') {
            let flag = -elementWidth;
            setInterval(() => {
                element.style.marginLeft = ++flag + "px";
                if (parentWidth == flag) {

                    index = index + 1;
                    if (listTextFooter[index] === undefined) {
                        index = 0;
                    }
                    $('p#animate_footer').text(listTextFooter[index].text);
                    flag = -elementWidth;
                }
            }, 10);
        } else {
            let flag = parentWidth;
            setInterval(() => {
                element.style.marginLeft = --flag + "px";
                if (flag === (0 - elementWidth)) {
                    index = index + 1;
                    if (listTextFooter[index] === undefined) {
                        index = 0;
                    }

                    $('p#animate_footer').text(listTextFooter[index].text);
                    flag = parentWidth;
                }
            }, 10);
        }

    }
</script>
