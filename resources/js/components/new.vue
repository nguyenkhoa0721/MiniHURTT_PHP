
<template>
  <div class="container is-max-desktop">
    <div class="columns is-centered">
      <div class="column is-half mt-5 pt-5">
        <div class="field">
          <label class="label">Name</label>
          <div class="control">
            <input v-model="name" class="input" type="text" />
          </div>
        </div>

        <div class="field">
          <label class="label">Link</label>
          <div class="control">
            <input v-model="link" class="input" />
          </div>
        </div>
        <div class="field is-grouped">
          <div class="control">
            <button
              class="button is-primary"
              @click="$router.push({ path: '/' })"
            >
              Back
            </button>
          </div>
          <div class="control">
            <button class="button is-primary" @click="addnew()">Add New</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "new",
  data() {
    return {
      name: "",
      link: "",
    };
  },
  methods: {
    addnew() {
      this.axios
        .post(
          "/",
          {
            name: this.name,
            link: this.link,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((res) => {
          this.name = "";
          this.link = "";
          alert('Tao moi thanh cong')
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

