
<template>
  <div v-if="name != ''" class="container is-max-desktop">
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
            <button class="button is-primary" @click="apply()">Apply</button>
          </div>
        </div>
      </div>
    </div>
    <div class="columns is-multiline is-mobile">
      <div class="column is-4" v-for="(item, index) in rec" :key="index">
        <div class="card has-background-white-bis mt-5">
          <div class="card-content">
            <div class="content">
              <strong class="text-with-dots">🟢 {{ item.name }}</strong>
              <div class="block pt-3">
                <button
                  class="button is-info is-small"
                  @click="routeto(item.id)"
                >
                  Edit
                </button>
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
  name: "edit",
  data() {
    return {
      name: "",
      link: "",
    };
  },
  created() {
    this.getdata();
  },
  methods: {
    getdata() {
      this.axios
        .get("/" + this.$route.params.id, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((res) => {
          this.name = res.data[0].name;
          this.link = res.data[0].link;
          this.rec = res.data[0].rec;
        })
        .catch(function (error) {
          alert("Khong ton tai");
          console.log(error);
        });
    },
    apply() {
      this.axios
        .put(
          "/" + this.$route.params.id,
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
          alert("Update thanh cong");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    routeto(id) {
      this.name = this.link = "";
      this.$router.push({
        path: "/edit/" + id,
      });
      this.getdata();
    },
  },
};
</script>

