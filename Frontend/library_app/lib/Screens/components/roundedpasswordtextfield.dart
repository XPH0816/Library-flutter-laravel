import 'package:flutter/material.dart';
import 'package:library_app/Screens/components/textfieldcontainer.dart';
import 'package:library_app/Screens/components/textfieldcontent.dart';

class RoundedPasswordTextField extends StatelessWidget {
  final double space;

  const RoundedPasswordTextField({
    Key? key,
    this.space = 0.04,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return TextFieldContainer(
        spaceBtwEach: 0,
        child: TextFieldContent(
            obscureText: true,
            icon: Icons.vpn_key_outlined,
            hintText: "Password"));
  }
}
