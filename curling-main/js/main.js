var DateDiff = {

    inDays: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2-t1)/(24*3600*1000));
    },

    inWeeks: function(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2-t1)/(24*3600*1000*7));
    },

    inMonths: function(d1, d2) {
        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();

        return (d2M+12*d2Y)-(d1M+12*d1Y);
    },

    inYears: function(d1, d2) {
        return d2.getFullYear()-d1.getFullYear();
    }
}

jQuery(document).ready(function($) {
    $('.nav-menu-primary .menu-item').each((index, element) => {
        const $this = $(element);
        const menu_name = $this.data('menu');
        const $popup = $(`.nav-menu-popup[data-name='${menu_name}']`);
        const $multi = $this.add(`.nav-menu-popup[data-name='${menu_name}']`);
        $multi.mouseenter(() => {
            $this.addClass('active');
            $popup.addClass('active');
        }).mouseleave(() => {
            $this.removeClass('active');
            $popup.removeClass('active');
        });
    });

    $('.block-timer').each((index, element) => {
        const $this = $(element);
        const unixTime = $this.data('date');

        const start = new Date(unixTime * 1000);

        updateTime($this, start);
        window.setInterval(function(){
            updateTime($this, start);
        }, 1000);
        
    });

    function updateTime($this, start) {
        const current = new Date();
        const totalseconds = (start - current) / 1000;
        const days = Math.floor(totalseconds / (3600 * 24));
        const hours = Math.floor((totalseconds - (days * (3600 * 24))) / 3600);
        const minutes = Math.floor((totalseconds - (days * (3600 * 24)) - (hours * 3600)) / 60);
        const seconds = Math.floor(totalseconds - (days * (3600 * 24)) - (hours * 3600) - (minutes * 60));

        $this.find('.js-days').text(days);
        $this.find('.js-hours').text(hours);
        $this.find('.js-minutes').text(minutes);
        $this.find('.js-seconds').text(seconds);
    }
});
