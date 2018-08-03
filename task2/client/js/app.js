new Vue({
    el: '#app',
    created() {
        this.fetchAllCars();
    },
    data: {
        api: 'http://soap.test/task2/client/soapClient/',
        cars: [],
        search: {
            action: 'getSearchCars',
            year: '',
            brand: ''
        },
        errors: '',
        hasError: false,
        detailCar: {
            id: '',
            model: '',
            brand: '',
            year: '',
            capasity: '',
            colour: '',
            price: '',
        },
        showDetail: false,
        showCarsBlock: true,
    },
    methods: {
        fetchAllCars() {


            this.$http.post(this.api, {
                action: 'getCars',
            },
            {
                emulateJSON: true
            }

            ).then(function (response) {
                this.showCarsBlock = true;
                this.cars = response.body;

            });


        },

        searchCars: function () {

            if (!this.search.year) {
                this.errors = 'year is required fields';
                this.hasError = true;
                return false;
            }

            this.$http.post(this.api, {
                action: this.search.action,
                year: this.search.year,
                brand: this.search.brand,

            },
            {
                emulateJSON: true
            }

            ).then(function (response) {
                this.errors = '';
                this.hasError = false;
                this.showCarsBlock = true;
                this.cars = response.body;


            });


        },

        getCarById: function (id) {

            this.$http.post(this.api, {
                action: 'getCarById',
                id: id,

            },
            {
                emulateJSON: true
            }

            ).then(function (response) {

                this.detailCar = response.body;
                this.errors = '';
                this.hasError = false;
            });
            this.showCarsBlock = false;
        }
    }
});