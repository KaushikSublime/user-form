<template>
    <div class="box">
        <b-container class="margin-top:20px">
            <b-form @submit="onSubmit" @reset="onReset">
                <text-component
                    lblName="Username"
                    id="txtName"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <text-component
                    lblName="Email"
                    id="txtEmail"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <phone-number
                    lblName="PhoneNo"
                    id="txtPhoneNo"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <text-area
                    lblName="Address"
                    id="txtAreaAddress"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
                <text-component
                    lblName="ZipCode"
                    id="txtZipCode"
                    @getInputVal="setInputData"
                    class="col-md-8"
                />
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
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-container>
        <p class="typo__p" v-if="submitStatus === 'OK'">
            Thanks for your submission!
        </p>
        <p class="typo__p" v-if="submitStatus === 'ERROR'">
            Please fill the form correctly.
        </p>
        <p class="typo__p" v-if="submitStatus === 'PENDING'">Sending...</p>
    </div>
</template>

<script>
import TextComponent from "../../components/file_controls/Text.vue";
import TextArea from "../../components/file_controls/TextArea.vue";
import Number from "../../components/file_controls/Number.vue";
import ImageComponent from "../../components/file_controls/Image.vue";
import { required, minLength } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone_number: "",
                address: "",
                zip_code: "",
                user_profile: "",
                user_license: ""
            },
            submitStatus: null
        };
    },
    components: {
        TextComponent,
        TextArea,
        "phone-number": Number,
        ImageComponent
    },
    // validations: {
    //     name: {
    //         required,
    //         minLength: minLength(4)
    //     }
    // },
    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            /* if (this.$v.$invalid) {
                this.submitStatus = "ERROR";
            } else {
                // do your submit logic here
                this.submitStatus = "PENDING";
                setTimeout(() => {
                    this.submitStatus = "OK";
                }, 500);
            }
            console.log(this.form);
 */
            console.log(this.$appUrl + "user");
            this.axios.post(this.$appUrl + "user", this.form).then(
                response =>
                    function(response) {
                        if (response.success) {
                            alert(response.msg);
                        } else {
                            alert(response.msg);
                        }
                    }
            );
        },
        onReset(evt) {
            evt.preventDefault();
            this.form.email = "";
            this.form.name = "";
        },
        setInputData(data) {
            this.fieldWiseSetData(data);
        },
        fieldWiseSetData(data) {
            switch (data.type) {
                case "Username":
                    this.form.name = data.val;
                    break;
                    Username;
                case "Email":
                    this.form.email = data.val;
                    break;
                case "PhoneNo":
                    this.form.phone_number = data.val;
                    break;
                case "Address":
                    this.form.address = data.val;
                    break;
                case "ZipCode":
                    this.form.zip_code = data.val;
                    break;
                case "UserProfile":
                    this.form.user_profile = data.val;
                    break;
                case "UserLicense":
                    this.form.user_license = data.val;
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
</style>
