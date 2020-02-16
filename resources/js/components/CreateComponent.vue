<template>
    <div class="container">
        <a href="/home">Go Back</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{operator.name}} - make payment</div>

                    <div class="card-body">
                        Your current balance: {{curBalance}}
                        <div v-if="loading">
                            <BlockUI message="Please wait..."></BlockUI>
                        </div>
                        <div v-else>
                            <div class="mt-3">
                                <form v-on:submit.prevent="create()">
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <the-mask
                                            type="phone"
                                            mask="'+#(###)###-##-##'"
                                            v-model="phone"
                                            :masked="false"
                                            placeholder="+7(123)456-69-79"
                                            id="phone"
                                            name="phone"
                                            class="form-control"
                                            v-bind:class="{'is-invalid' : !validData.phone[0]}"
                                        ></the-mask>
                                        <!--                                    <input type="phone" placeholder="+7(123)456-69-79" class="form-control" id="phone" name="phone" v-mask="'+#(###)###-##-##'" v-model="phone">-->
                                        <small id="phoneHelp" class="form-text text-muted">Please enter your phone number.</small>
                                        <div class="invalid-feedback" v-show="!validData.phone[0]">
                                            {{validData.phone[1]}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="text" class="form-control" id="amount" name="amount" v-model="amount" v-bind:class="{'is-invalid' : !validData.amount[0]}">
                                            <div class="invalid-feedback" v-show="!validData.amount[0]">
                                                {{validData.amount[1]}}
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Make payment</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            operator: {
                type: Object,
                required: true
            },
            balance: {
                type: Number,
                required: true
            },
            createurl: {
                type: String,
                required: true
            },
            user: {
                type: Object,
                required: true
            },
            ins: {
                type: Number,
                required: false
            },
            outs: {
                type: Number,
                required: false
            }
        },
        data() {
            return {
                phone: null,
                amount: null,
                loading: false,
                curBalance: null,
                validData: {
                    'phone': [true, ''],
                    'amount': [true, ''],
                }
            }
        },
        methods: {
            payload() {
                return {
                    'phone' : this.phone,
                    'amount' : this.amount,
                    'operator_id' : this.operator.id,
                    'user_id' : this.user.id,
                    'type' : 'in'
                }
            },
            clearValidation() {
                this.validData = Object.assign({}, this.validData, {
                    'phone' : [true, 'There was an error in phone field'],
                    'amount' : [true, 'There was an error in amount field']
                })
            },
            create() {
                var thisInstance = this;
                this.loading = true;
                axios.post(this.endpoint, this.payload())
                    .catch(({response}) => {
                        thisInstance.$toast.error(response.data.message, "Error", { timeout: 3000 });
                        if (response.status == 422) {
                            thisInstance.clearValidation();
                            for (var prop in response.data.errors) {
                                thisInstance.$set(thisInstance.validData, prop, [false, response.data.errors[prop][0]]);
                            }
                        }
                    })
                    .then(({data}) => {
                        thisInstance.$toast.success('Payment created successfully', "Success", { timeout: 3000 });
                        thisInstance.phone = null;
                        thisInstance.amount = null;
                        thisInstance.clearValidation();
                        const amount = parseFloat(data.data.amount);
                        const startAmount = parseFloat(thisInstance.curBalance);
                        thisInstance.curBalance = startAmount + amount;
                    })
                    .finally(response => {
                        thisInstance.loading = false;
                    });
            },
        },
        computed: {
            endpoint() {
                // return '/payment';
                return this.createurl;
            }
        },
        mounted() {
            this.curBalance = this.balance;
        }
    }
</script>
