<template>
  <div>
    <h2>New Loan</h2>

    <form @submit.prevent="addloan" class="mb-3">
      <div class="form-row mb-2">
        <div class="col">
          <input type="text" class="form-control" placeholder="serial" v-model="loan.serial">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="amount" v-model="loan.amount">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="status" v-model="loan.status">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="status_label" v-model="loan.status_label">
        </div>
      </div>
      <div class="form-row mb-2">
        <div class="col">
          <input type="text" class="form-control" placeholder="expire_at" v-model="loan.expire_at">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="period" v-model="loan.period">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="purpose" v-model="loan.purpose">
        </div>
      </div>  
      <div class="form-row mb-2">
        <div class="col">
          <input type="text" class="form-control" placeholder="description" v-model="loan.description">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="credit_level" v-model="loan.credit_level">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="apr" v-model="loan.apr">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="pgr" v-model="loan.pgr">
        </div>
      </div>  
      <button type="submit" class="btn btn-dark btn-block">New</button>

    </form>
    <h2>Ava Loans</h2>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchloans(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchloans(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    <div class="card card-body mb-2" v-for="loan in loans" v-bind:key="loan.id">
      <h3>{{ loan.serial }}</h3>
      <p>{{ JSON.stringify(loan, null, 2) }}</p>
      <hr>
     
     
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      loans: [],
      loan: {
        id: '',
        serial: '',
        amount: '',
        status: '',
        status_label: '',
        expire_at: '',
        period: '',
        purpose: '', 
        description: '',
        credit_level: '',
        apr: '',
        pgr: '',
      },
      loan_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchloans();
  },
  
  
  methods: {
    getLoanUrl (){ return "/api/loans"} ,

    fetchloans(page_url) {
      let vm = this;
      page_url = page_url || this.getLoanUrl()
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.loans = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
   
    addloan() {
      console.log(this.loan)
      if (this.edit === false) {
        // Add
        fetch(this.getLoanUrl(), {
          method: 'post',
          body: JSON.stringify(this.loan),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {

            alert('loan Added');
            this.fetchloans();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch(this.getLoanUrl(), {
          method: 'put',
          body: JSON.stringify(this.loan),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.loan.title = '';
            this.loan.body = '';
            alert('loan Updated');
            this.fetchloans();
          })
          .catch(err => console.log(err));
      }
    },

  }
};
</script>