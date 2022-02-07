export default function authHeader() {
  let token = localStorage.getItem("user-token");
  if (token) {
    return {
      Authorization: "Bearer " + token,
      "Content-Type": "application/json",
    };
  } else {
    return {
      "Content-Type": "application/json",
    };
  }
}
