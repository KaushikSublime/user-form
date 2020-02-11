<template>
    <div class="box">
        <b-container class="margin-top:20px">
            <b-form @submit="onSubmit" @reset="onReset">
                <text-component
                    lblName="Username"
                    id="txtName"
                    @getInputVal="setInputData"
                    class="col-md-8"
                    :class="{ error: $v.form.name.$error }"
                />
                <text-component
                    lblName="Email"
                    id="txtEmail"
                    @getInputVal="setInputData"
                    class="col-md-8"
                    :class="{ error: $v.form.email.$error }"
                />
                <phone-number
                    lblName="PhoneNo"
                    id="txtPhoneNo"
                    @getInputVal="setInputData"
                    class="col-md-8"
                    :class="{ error: $v.form.phone.$error }"
                />
                <text-area
                    lblName="Address"
                    id="txtAreaAddress"
                    @getInputVal="setInputData"
                    class="col-md-8"
                    :class="{ error: $v.form.address.$error }"
                />

                <text-component
                    lblName="ZipCode"
                    id="txtZipCode"
                    @getInputVal="setInputData"
                    class="col-md-8"
                    :class="{ error: $v.form.zip.$error }"
                />
                <div class="error" v-if="!$v.form.zip.minLength">
                    ZipCode must have
                    {{ $v.form.zip.$params.minLength.min }} digits.
                </div>
                <div class="error" v-if="!$v.form.zip.maxLength">
                    ZipCode not greter than
                    {{ $v.form.zip.$params.maxLength.max }} digits.
                </div>
                <div class="error" v-if="!$v.form.zip.numeric">
                    Zipcode is numeric.
                </div>

                <image-component
                    lblName="UserProfile"
                    id="userImageUploadProfile"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <image-component
                    lblName="UserLicense"
                    id="userImageUploadLicense"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <p class="typo__p" v-if="submitStatus === 'OK'">
                    Thanks for your submission!
                </p>
                <p class="error" v-if="submitStatus === 'ERROR'">
                    Please fill the form correctly.
                </p>
                <p class="typo__p" v-if="submitStatus === 'PENDING'">
                    Sending...
                </p>

                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-container>
    </div>
</template>

<script>
import TextComponent from "../../components/file_controls/Text.vue";
import TextArea from "../../components/file_controls/TextArea.vue";
import Number from "../../components/file_controls/Number.vue";
import ImageComponent from "../../components/file_controls/Image.vue";

import {
    required,
    email,
    numeric,
    minLength,
    maxLength
} from "vuelidate/lib/validators";

export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                address: "",
                zip: "",
                profile: "",
                user_license: ""
            },
            submitStatus: false
        };
    },
    components: {
        TextComponent,
        TextArea,
        "phone-number": Number,
        ImageComponent
    },
    validations: {
        form: {
            name: { required },
            email: { required, email },
            phone: {
                required
            },
            address: { required },
            zip: {
                required,
                numeric,
                minLength: minLength(5),
                maxLength: maxLength(5)
            }
        }
    },
    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            this.$v.form.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = "ERROR";
                console.log(this.$v.form.name.$error, this.submitStatus);
            } else {
                this.submitStatus = "PENDING";
                setTimeout(() => {
                    this.submitStatus = "OK";
                    console.log(this.form);
                    this.axios.post(this.$appUrl + "user", this.form).then(
                        response =>
                            function(response) {
                                if (response.success) {
                                    alert(response.message);
                                    this.clearForm();
                                } else {
                                    alert(response.message);
                                }
                            }
                    );
                });
            }
        },
        onReset() {
            this.clearForm();
        },
        setInputData(data) {
            this.fieldWiseSetData(data);
        },
        clearForm() {
            this.form = {};
            this.submitStatus = null;
        },
        fieldWiseSetData(data) {
            const reader = new FileReader();
            switch (data.type) {
                case "Username":
                    this.form.name = data.val;
                    break;
                case "Email":
                    this.form.email = data.val;
                    break;
                case "PhoneNo":
                    this.form.phone = data.val;
                    break;
                case "Address":
                    this.form.address = data.val;
                    break;
                case "ZipCode":
                    this.form.zip = data.val;
                    break;
                case "UserProfile":
                    reader.readAsDataURL(data.val);
                    reader.onload = e => {
                        this.form.profile = e.target.result;
                    };
                    break;
                case "UserLicense":
                    reader.readAsDataURL(data.val);
                    reader.onload = e => {
                        this.form.user_license = e.target.result;
                    };
                    break;
            }
        }
    }
};
</script>
<style scoped>
.box {
    margin: auto;
    width: 50%;
    padding: 10px;
}
.error {
    color: red;
}
</style>
