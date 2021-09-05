import 'package:flutter/material.dart';
import 'package:library_app/Screens/components/textfieldcontainer.dart';
import 'package:library_app/Screens/components/textfieldcontent.dart';

class RoundedTextField extends StatelessWidget {
  final double space;
  final String hintText;

  const RoundedTextField({
    Key? key,
    required this.hintText,
    this.space = 0.04,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return TextFieldContainer(
      spaceBtwEach: size.height * (space - 0.02),
      child: TextFieldContent(
        icon: Icons.person_outlined,
        hintText: hintText,
      ),
    );
  }
}
