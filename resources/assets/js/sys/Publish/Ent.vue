<template>
    <form novalidate @submit.prevent="validateForm">
        <md-card>
            <md-card-header>
                <div class="md-title">发布企业</div>
            </md-card-header>
            <md-card-content>
                <span>将企业发布到移动服务，即可在移动端使用。移动端不存储任何业务数据!</span>
            </md-card-content>
            <md-card-content>
                <md-field :class="getValidationClass('account')">
                    <label>用户账号</label>
                    <md-input v-model="mainData.account"></md-input>
                </md-field>
                <md-field :class="getValidationClass('token')">
                    <label>用户密钥</label>
                    <md-input v-model="mainData.token" type="password"></md-input>
                </md-field>
                <md-field :class="getValidationClass('discover')">
                    <label>移动服务地址</label>
                    <md-input v-model="mainData.discover"></md-input>
                </md-field>
                <md-field :class="getValidationClass('gateway')">
                    <label>网关地址</label>
                    <md-input v-model="mainData.gateway"></md-input>
                    <span class="md-helper-text">如：http://192.168.12.18:8635</span>
                </md-field>
            </md-card-content>
            <md-card-actions>
                <md-button type="submit" class="md-accent md-raised" :disabled="$v.$invalid">发布</md-button>
            </md-card-actions>
        </md-card>
    </form>
</template>
<script>
    import {
        validationMixin
    } from 'vuelidate'
    import {
        required,
        minLength,
        maxLength
    } from 'vuelidate/lib/validators'

    export default {
        name: 'SysPublishEnt',
        data() {
            return {
                mainData: {
                    discover: 'http://m.myamiba.cn'
                }
            };
        },
        mixins: [validationMixin],
        validations: {
            mainData: {
                token: {
                    required
                },
                account: {
                    required
                },
                discover: {
                    required
                },
                gateway: {
                    required
                }
            }
        },
        methods: {
            getValidationClass(fieldName) {
                const field = this.$v.mainData[fieldName];
                if (field) {
                    return {
                        "md-invalid": field.$invalid && field.$dirty
                    };
                }
            },
            postFormData() {
                this.$tip.waiting("正在发布...");
                this.$http.post("sys/ents/publish", this.mainData)
                    .then(
                        res => {
                            this.$tip.clear();
                            this.$toast('发布成功');
                        },
                        err => {
                            this.$toast(err);
                        }
                    );
            },
            validateForm() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.postFormData();
                }
            },
        },
        created() {

        },
    };
</script>
<style scoped>
    form {
        max-width: 600px;
        margin: 10px auto;
    }
</style>