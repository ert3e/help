<template>
    <div>
        <div class="donate-form__row donate-form-interval" id="donate-form-interval" v-if="['fond', 'services'].includes(selectedType)">

            <label v-for="(data, value) in intervalsData">
                <input type="radio" name="interval" :value="value" :checked="value == Object.keys(intervalsData)[0]">
                <span><i></i></span>
                <small>{{ data.title }}</small>
            </label>

        </div>

        <div class="donate-form__row donate-form-phone">
            <small>Номер телефона</small>
            <input type="text" placeholder="+7 999 999 99 99" name="telephone">
        </div>

        <div class="donate-form__row donate-form-sum">
            <div class="donate-form-sum__left">
                <small>Сумма пожертвования</small>
                <div class="inputs">
                    <label>
                        <input type="radio" name="sum_ready" value="100" checked>
                        <span>100 ₽</span>
                    </label>
                    <label>
                        <input type="radio" name="sum_ready" value="250">
                        <span>250 ₽</span>
                    </label>
                    <label>
                        <input type="radio" name="sum_ready" value="500">
                        <span>500 ₽</span>
                    </label>
                    <label>
                        <input type="radio" name="sum_ready" value="1000">
                        <span>1000 ₽</span>
                    </label>
                </div>
            </div>
            <div class="donate-form-sum__right">
                <small>Другая сумма</small>
                <input type="number" placeholder="100 ₽" min="1" name="sum_number">
            </div>
        </div>
        <div class="donate-form__row donate-form-selects">
            <div>
                <small>Тип пожертвования</small>
                <div class="select">
                    <select name="donation_type" @change="selectType($event)" v-model="selectedType">
                        <option v-for="(object, value) in parseData" :value="value">
                            {{ object.title }}
                        </option>
                    </select>
                </div>
            </div>

            <div id="person" v-if="selectedType == 'needHelp'">
                <small>Выберите нуждающегося</small>
                <div class="select">
                    <select name="picking" v-model="selectedId" required>
                        <option v-for="(name, id) in parseData.needHelp.list" :value="id">
                            {{ name }}
                        </option>
                    </select>
                </div>
            </div>

            <div id="program" v-if="selectedType == 'services'">
                <small>Выберите программу</small>
                <div class="select">
                    <select name="program" @change="selectId($event)" v-model="selectedId" required>
                        <option v-for="(title, id) in parseData.services.list" :value="id">
                            {{ title }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default  {
    props: [
        'data', 'selected', 'intervals',
    ],
    data: function() {
        return {
            'parseData': JSON.parse(this.data),
            'parseSelected': JSON.parse(this.selected),
            'intervalsData': JSON.parse(this.intervals),
            'selectedType': 'needHelp',
            'selectedId': '0',
        }
    },
    mounted() {
        this.selectedType = this.parseSelected.type ?? 'needHelp';
        this.selectedId = this.parseSelected.id ?? Object.keys(this.parseData[this.selectedType]['list'])[0];
    },
    methods: {
        selectType: function (event) {
            this.selectedType = event.target.value;
            if (this.parseData[this.selectedType]['list']) {
                this.selectedId = Object.keys(this.parseData[this.selectedType]['list'])[0];
            }
        },
    }
}
</script>
