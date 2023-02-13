<template>
      <form style="width: 100%" method="post">
        <div class="form-group row">
          <label for="title" class="col-md-2 col-form-label">Заголовок</label>
          <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                id="title"
                v-model="forValidation.title"
                ref="title"
            >
            <div v-if="errorTitle" class="text-danger">{{errorTitle}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="annotation" class="col-md-2 col-form-label">Аннотация</label>
          <div class="col-md-10">
                    <textarea
                        id="annotation"
                        class="form-control"
                        cols="30"
                        rows="10"
                        v-model="forValidation.annotation"
                        ref="annotation"></textarea>
            <div v-if="errorAnnotation" class="text-danger">{{errorAnnotation}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="content" class="col-md-2 col-form-label">Текст новости</label>
          <div class="col-md-10">
                    <textarea
                        ref="content"
                        id="content"
                        class="form-control"
                        cols="30"
                        rows="10"
                        v-model="forValidation.content"></textarea>
            <div v-if="errorContent" class="text-danger">{{errorContent}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="email" class="col-md-2 col-form-label">Email  автора для связи</label>
          <div class="col-md-10">
            <input
                type="email"
                class="form-control"
                id="email"
                ref="email"
                v-model="forValidation.email"
            >
            <div v-if="errorEmail" class="text-danger">{{errorEmail}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="views" class="col-md-2 col-form-label">Кол-во просмотров</label>
          <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                id="views"
                ref="views"
                v-model="forValidation.views"
            >
            <div v-if="errorViews" class="text-danger">{{errorViews}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
          <div class="col-md-10">
            <input
                type="date"
                class="form-control"
                id="date"
                ref="date"
                v-model="forValidation.date"
            >
            <div v-if="errorDate" class="text-danger">{{errorDate}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="is_publish" class="col-md-2 col-form-label">Публичная новость</label>
          <div class="col-md-10 form-switch d-flex justify-content-center align-items-center">
            <input
                type="checkbox"
                class="form-check-input my-class"
                id="is_publish"
                name="is_publish"
            >
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label class="col-md-2 col-form-label">Публиковать на главной</label>
          <div class="col-md-10">
            <div class="form-check">
              <input class="form-check-input" name="publish_in_index" type="checkbox" id="publish_in_index" v-model="forValidation.publish_in_index">
              <label class="form-check-label" for="publish_in_index_yes">
                Да
              </label>
            </div>
            <div v-if="errorPublished" class="text-danger">{{errorPublished}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <label for="category" class="col-md-2 col-form-label">Категорія</label>
          <div class="col-md-10">
            <select id="category" class="form-control" name="category" v-model="forValidation.category">
              <option disabled selected>Выберете категорию из списка..</option>
              <option value="1">Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div v-if="errorCategory" class="text-danger">{{errorCategory}}</div>
          </div>
        </div>
        <br>
        <div class="form-group row">
          <div class="col-md-9">
            <button type="submit" @click.prevent="validateInput();" class="btn btn-primary">Отправить</button>
          </div>
          <div class="col-md-3">
            <div class="alert alert-success text-center" v-if="forValidation.success">Форма валідна</div>
            <div class="alert alert-danger" v-else>Форма невалідна</div>
          </div>
        </div>
      </form>
</template>

<script>
import axios from "axios";
export default {
  name: 'ValidForm',
  data() {
    return {
      forValidation: {
        title:'',
        annotation:'',
        content:'',
        email:'',
        views:'',
        date:'',
        publish_in_index:null,
        category:0,
        success:false,
      },
      errorTitle: '',
      errorAnnotation: '',
      errorContent: '',
      errorEmail: '',
      errorViews: '',
      errorDate: '',
      errorPublished: '',
      errorCategory: '',
    }
  },
  props: {

  },
  methods:{
    validateInput() {
let valForm = this.toFormData(this.forValidation);
axios.post('http://127.0.0.1:8876/validate.php',valForm)
    .then( (response) => {
      console.log(response);
      this.validate(response);
    });
    },
    validate($resp) {
      this.errorPublished = '';
      this.errorDate = '';
      this.errorViews = '';
      this.errorEmail = '';
      this.errorTitle = '';
      this.errorAnnotation = '';
      this.errorContent = '';
      this.errorCategory = '',
          this.forValidation.success = false;
      if($resp.data.title) {
        this.errorTitle = $resp.data.message;
        this.$refs.title.focus();
      }
      if($resp.data.annotation) {
        this.errorAnnotation = $resp.data.message;
        this.$refs.annotation.focus();
      }
      if($resp.data.content) {
        this.errorContent = $resp.data.message;
        this.$refs.content.focus();
      }
      if($resp.data.email) {
        this.errorEmail = $resp.data.message;
        this.$refs.email.focus();
      }
      if($resp.data.views) {
        this.errorViews = $resp.data.message;
        this.$refs.views.focus();
      }
      if($resp.data.date) {
        this.errorDate = $resp.data.message;
        this.$refs.date.focus();
      }
      if($resp.data.publish) {
        this.errorPublished = $resp.data.message;
      }
      if($resp.data.category) {
        this.errorCategory = $resp.data.message;
      }
      if($resp.data.success){
        this.forValidation.success = true;
      }
    },
    toFormData(obj) {
      let form_data = new FormData();
      for(let key in obj){
        form_data.append(key,obj[key]);
      }
      return form_data;
    },
  },
}
</script>


<style scoped>
.my-class {
  width:15% !important;
  height:50px;
}
</style>
