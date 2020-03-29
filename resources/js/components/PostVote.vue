<template>
  <div class="btn-group-vertical">
    <button class="btn" @click="voteUp" :class="{'btn-info': didVoteUp}">
      <i class="fas fa-thumbs-up"></i>
    </button>

    <button class="btn">{{ totalVotes }}</button>

    <button class="btn" @click="voteDown" :class="{'btn-info': didVoteDown}">
      <span>
        <i class="fas fa-thumbs-down"></i>
      </span>
    </button>
  </div>
</template>


<script>
const VOTE_UP = 1;
const VOTE_DOWN = -1;
const NO_VOTE = 0;

export default {
  props: {
    postId: {
      prop: Number
    },

    currentVotes: {
      prop: Number,
      default: 0
    },

    userVote: {
      prop: Number,
      default: NO_VOTE
    }
  },

  data() {
    return {
      internalUserVote: NO_VOTE
    };
  },

  computed: {
    didVoteUp() {
      return this.internalUserVote === VOTE_UP;
    },
    didVoteDown() {
      return this.internalUserVote === VOTE_DOWN;
    },

    totalVotes() {
      return this.currentVotes + this.internalUserVote;
    }
  },

  methods: {
    voteUp() {
      this.vote(VOTE_UP);
    },

    voteDown() {
      this.vote(VOTE_DOWN);
    },

    vote(vote) {
      if (this.internalUserVote === vote) {
        this.internalUserVote = NO_VOTE;
      } else {
        this.internalUserVote = vote;
      }

      axios
        .post(`/posts/${this.postId}/vote`, { vote: this.internalUserVote })
        .then(response => {})
        .catch(err => {});
    }
  },

  mounted() {
    this.internalUserVote = this.userVote;
  }
};
</script>
